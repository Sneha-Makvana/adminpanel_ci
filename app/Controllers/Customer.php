<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Customer extends Controller
{

    public function create()
    {
        return view('customer/customer');
    }

    public function view()
    {
        return view('customer/view');
    }
}
