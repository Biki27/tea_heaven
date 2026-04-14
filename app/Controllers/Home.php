<?php
namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        // Load the model
        $productModel = new ProductModel();

        // Fetch products where is_best_seller = 1
        $data['best_sellers'] = $productModel->where('is_best_seller', 1)->findAll();
        $data['title'] = 'Home - Tea Haven';
        

        // Pass the data to the view
        return view('homeView', $data);
    }
}