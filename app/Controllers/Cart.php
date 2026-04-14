<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\CartItemModel;

class Cart extends BaseController
{
    public function index()
    {
        $data['cart'] = $this->getCartContents();
        
        // Calculate totals
        $data['subtotal'] = 0;
        foreach ($data['cart'] as $item) {
            $data['subtotal'] += ($item['price'] * $item['qty']);
        }
        $data['tax'] = $data['subtotal'] * 0.05;
        $data['total'] = $data['subtotal'] + $data['tax'];

        return view('cartView', $data);
    }

    public function add()
    {
        $productId = $this->request->getPost('product_id');
        $qty = $this->request->getPost('qty') ?? 1;
        $productModel = new ProductModel();
        $product = $productModel->find($productId);
        
        if (!$product) return redirect()->back();

        if (session()->get('is_logged_in')) {
            // DATABASE CART LOGIC
            $cartModel = new CartModel();
            $cartItemModel = new CartItemModel();
            $userId = session()->get('user_id');

            $cart = $cartModel->where('user_id', $userId)->first();
            if (!$cart) {
                $cartModel->insert(['user_id' => $userId]);
                $cartId = $cartModel->getInsertID();
            } else {
                $cartId = $cart['id'];
            }

            $existingItem = $cartItemModel->where(['cart_id' => $cartId, 'product_id' => $productId])->first();
            if ($existingItem) {
                $cartItemModel->update($existingItem['id'], ['qty' => $existingItem['qty'] + $qty]);
            } else {
                $cartItemModel->insert(['cart_id' => $cartId, 'product_id' => $productId, 'qty' => $qty]);
            }
        } else {
            // SESSION CART LOGIC (For Guests)
            $cart = session()->get('cart') ?? [];
            if (isset($cart[$productId])) {
                $cart[$productId]['qty'] += $qty;
            } else {
                $cart[$productId] = [
                    'id' => $product['id'], 'name' => $product['name'], 
                    'price' => $product['price'], 'image_path' => $product['image_path'], 'qty' => $qty
                ];
            }
            session()->set('cart', $cart);
        }

        return redirect()->back()->with('message', 'Item added to cart!');
    }

    public function remove($productId)
    {
        if (session()->get('is_logged_in')) {
            $cartModel = new CartModel();
            $cartItemModel = new CartItemModel();
            $cart = $cartModel->where('user_id', session()->get('user_id'))->first();
            if ($cart) {
                $cartItemModel->where(['cart_id' => $cart['id'], 'product_id' => $productId])->delete();
            }
        } else {
            $cart = session()->get('cart') ?? [];
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->set('cart', $cart);
            }
        }
        return redirect()->to('/cart');
    }

    // Helper method to unify data structure for the View
    private function getCartContents()
    {
        if (session()->get('is_logged_in')) {
            $cartModel = new CartModel();
            $cart = $cartModel->where('user_id', session()->get('user_id'))->first();
            if (!$cart) return [];

            $db = \Config\Database::connect();
            return $db->table('cart_items')
                      ->select('cart_items.product_id as id, cart_items.qty, products.name, products.price, products.image_path')
                      ->join('products', 'products.id = cart_items.product_id')
                      ->where('cart_items.cart_id', $cart['id'])
                      ->get()->getResultArray();
        } else {
            return session()->get('cart') ?? [];
        }
    }
}