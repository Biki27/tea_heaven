<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        // If already logged in, redirect to shop
        if (session()->get('is_logged_in')) {
            return redirect()->to('/shop');
        }
        return view('authView');
    }

    public function register()
    {
        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $userModel = new UserModel();
        
        // The Model's beforeInsert callback will automatically hash this password
        $userModel->insert([
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => $this->request->getPost('password')
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! Please sign in.');
    }

   public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            // 1. Set Auth Session
            session()->set([
                'user_id'      => $user['id'],
                'user_name'    => $user['name'],
                'is_logged_in' => true
            ]);
            
            // 2. THE CART MERGE LOGIC
            $cartModel = new \App\Models\CartModel();
            $cartItemModel = new \App\Models\CartItemModel();
            
            // Find or create their permanent DB Cart
            $dbCart = $cartModel->where('user_id', $user['id'])->first();
            if (!$dbCart) {
                $cartModel->insert(['user_id' => $user['id']]);
                $cartId = $cartModel->getInsertID();
            } else {
                $cartId = $dbCart['id'];
            }

            // If they had items as a guest, move them to the DB
            $sessionCart = session()->get('cart');
            if (!empty($sessionCart)) {
                foreach ($sessionCart as $productId => $item) {
                    $existingItem = $cartItemModel->where(['cart_id' => $cartId, 'product_id' => $productId])->first();
                    if ($existingItem) {
                        // Increase qty if already in DB cart
                        $cartItemModel->update($existingItem['id'], ['qty' => $existingItem['qty'] + $item['qty']]);
                    } else {
                        // Insert new item
                        $cartItemModel->insert([
                            'cart_id'    => $cartId,
                            'product_id' => $productId,
                            'qty'        => $item['qty']
                        ]);
                    }
                }
                session()->remove('cart'); // Destroy guest cart
            }

            // 3. Handle Redirect
            $redirectUrl = session()->get('redirect_url') ?? '/shop';
            session()->remove('redirect_url');
            
            return redirect()->to($redirectUrl)->with('success', 'Welcome back, ' . $user['name']);
        }

        return redirect()->back()->with('error', 'Invalid Email or Password.');
    }
   public function logout()
    {
        // Explicitly remove the login flag
        session()->remove('is_logged_in');
        session()->remove('user_id');
        session()->remove('user_name');
        
        // Then destroy the whole thing
        session()->destroy();
        
        return redirect()->to('/login')->with('success', 'You have been safely logged out.');
    }
}