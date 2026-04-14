<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // The view() function loads HTML files from the app/Views folder
        return view('tea_heaven_home');
    }
}