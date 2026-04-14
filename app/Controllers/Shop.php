<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Shop extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        // Fetch all products and categories
        $data['products'] = $productModel->findAll();
        $data['categories'] = $categoryModel->findAll();

        return view('shopView', $data);
    }
}