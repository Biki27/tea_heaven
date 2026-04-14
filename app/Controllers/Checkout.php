<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Checkout extends BaseController
{
    public function index()
    {
        // PULL FROM DATABASE, NOT SESSION
        $db = \Config\Database::connect();
        $cartModel = new \App\Models\CartModel();
        
        $cart = $cartModel->where('user_id', session()->get('user_id'))->first();
        $data['cart'] = [];
        
        if ($cart) {
            $data['cart'] = $db->table('cart_items')
                               ->select('cart_items.product_id as id, cart_items.qty, products.name, products.price')
                               ->join('products', 'products.id = cart_items.product_id')
                               ->where('cart_items.cart_id', $cart['id'])
                               ->get()->getResultArray();
        }

        if (empty($data['cart'])) {
            return redirect()->to('/shop')->with('error', 'Your cart is empty.');
        }

        // Calculate totals for the summary
        $data['subtotal'] = 0;
        foreach ($data['cart'] as $item) {
            $data['subtotal'] += ($item['price'] * $item['qty']);
        }
        $data['tax'] = $data['subtotal'] * 0.05;
        $data['total'] = $data['subtotal'] + $data['tax'];

        return view('checkoutView', $data);
    }

    public function process()
    {
        $session = session();
        $cart = $session->get('cart');

        if (empty($cart)) {
            return redirect()->to('/shop');
        }

        // 1. Recalculate totals server-side (Never trust user input for prices!)
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['qty']);
        }
        $tax = $subtotal * 0.05;
        $total = $subtotal + $tax;

        // 2. Prepare Order Data
        $orderData = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'address'        => $this->request->getPost('address'),
            'city'           => $this->request->getPost('city'),
            'pin_code'       => $this->request->getPost('pin_code'),
            'country'        => $this->request->getPost('country'),
            'phone'          => $this->request->getPost('phone'),
            'payment_method' => $this->request->getPost('payment'),
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'total'          => $total,
        ];

        $db = \Config\Database::connect();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // 3. START DATABASE TRANSACTION
        $db->transStart();

        // Insert Order
        $orderModel->insert($orderData);
        $orderId = $orderModel->getInsertID();

        // Insert Order Items
        foreach ($cart as $item) {
            $orderItemModel->insert([
                'order_id'     => $orderId,
                'product_id'   => $item['id'],
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'qty'          => $item['qty']
            ]);
        }

        // 4. COMPLETE TRANSACTION
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Checkout failed. Please try again.');
        } else {
            // Success! Clear the DATABASE cart items
            $cartModel = new \App\Models\CartModel();
            $cartItemModel = new \App\Models\CartItemModel();
            $userCart = $cartModel->where('user_id', session()->get('user_id'))->first();
            
            if ($userCart) {
                $cartItemModel->where('cart_id', $userCart['id'])->delete();
            }
            
            return redirect()->to('/checkout/success');
        }
    }

    public function success()
    {
        return view('successView');
    }
}