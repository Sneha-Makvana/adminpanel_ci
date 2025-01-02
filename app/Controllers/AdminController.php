<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\EventModel;
use App\Models\BookingModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
       return view('admin/dashboard');
    }

   
}
