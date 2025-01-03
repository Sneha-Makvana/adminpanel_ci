<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Check if the user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Initialize models
        $customerModel = new CustomerModel();
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        // Get counts for dashboard
        $totalCustomers = $customerModel->countAllResults();
        $totalProducts = $productModel->countAllResults();
        $totalOrders = $orderModel->countAllResults();

        // Get the latest 5 orders
        $latestOrders = $orderModel
            ->select('orders.id, customer.name as customer_name, products.product_name, orders.quantity, products.price, (orders.quantity * products.price) as total, orders.order_date')
            ->join('customer', 'customer.id = orders.customer_id')
            ->join('products', 'products.id = orders.product_id')
            ->orderBy('orders.order_date', 'DESC')
            ->findAll(5);

        return view('admin/dashboard', [
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'latestOrders' => $latestOrders,
            'title' => 'Dashboard',
        ]);
    }
}
