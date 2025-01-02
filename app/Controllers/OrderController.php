<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use CodeIgniter\Controller;

class OrderController extends Controller
{
    public function view()
    {
        return view('order/view');
    }

    public function create()
    {
        return view('order/order');
    }
}
