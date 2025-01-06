<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\LoginModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $customerModel = new CustomerModel();
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $totalCustomers = $customerModel->countAllResults();
        $totalProducts = $productModel->countAllResults();
        $totalOrders = $orderModel->countAllResults();

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
    public function display()
    {
        return view('admin/profile');
    }
    public function getProfile()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $loginModel = new LoginModel();

        $user = $loginModel->find($userId);

        if ($user) {
            return $this->response->setJSON(['status' => true, 'data' => $user]);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'User not found']);
        }
    }
}
