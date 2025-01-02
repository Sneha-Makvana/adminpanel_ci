<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderModel;

class ProductController extends Controller
{
    public function create()
    {
        return view('product/product');
    }

    public function view()
    {
        return view('product/view');
    }

    
}
