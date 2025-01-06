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
        // $orderModel = new OrderModel();

        // $orders = $orderModel
        //     ->select('orders.id, customer.name as customer_name, products.product_name, products.price, orders.quantity, orders.total, orders.order_date')
        //     ->join('customer', 'customer.id = orders.customer_id')
        //     ->join('products', 'products.id = orders.product_id')
        //     ->findAll();

        return view('order/view');
    }

    public function create()
    {
        $customerModel = new CustomerModel();
        $productModel = new ProductModel();

        $customers = $customerModel->findAll();
        $products = $productModel->findAll();

        return view('order/order', ['customer' => $customers, 'product' => $products]);
    }

    public function submitBooking()
    {
        $request = $this->request;
        $orderData = $request->getPost('booking_data');

        // Check if booking_data is an array
        if (empty($orderData) || !is_array($orderData)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid or missing booking data.'
            ]);
        }

        $orderModel = new OrderModel();

        foreach ($orderData as $data) {
            // Validate each data element (you can add more validations here as needed)
            if (empty($data['customer_id']) || empty($data['product_id']) || empty($data['quantity']) || empty($data['total'])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'All fields (customer_id, product_id, quantity, total) are required.'
                ]);
            }

            // Insert each order into the database
            $orderModel->insert([
                'customer_id' => $data['customer_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'total' => $data['total']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Order submitted successfully'
        ]);
    }


    public function fetchOrders()
    {
        $orderModel = new OrderModel();
        $orders = $orderModel
            ->select('orders.id, customer.name as customer_name, products.product_name, products.price, orders.quantity, orders.total, orders.order_date')
            ->join('customer', 'customer.id = orders.customer_id')
            ->join('products', 'products.id = orders.product_id')
            ->findAll();

        if ($orders) {
            return $this->response->setJSON(['success' => true, 'orders' => $orders]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'No orders found.']);
        }
    }

    public function deleteBooking($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if ($order) {
            $orderModel->delete($id);
            return $this->response->setJSON(['success' => true, 'message' => 'Order deleted successfully.']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Order not found.']);
    }
    public function display($bookingId)
    {
        return view('order/profile', ['bookingId' => $bookingId]);
    }

    public function fetchOrderDetails($id)
    {
        $orderModel = new OrderModel();
        $customerModel = new CustomerModel();
        $productModel = new ProductModel();

        $order = $orderModel
            ->select('orders.id as order_id, orders.quantity, orders.total, orders.order_date, 
                 products.product_name, products.price, 
                 customer.name as customer_name, customer.email, customer.phone_no')
            ->join('products', 'products.id = orders.product_id')
            ->join('customer', 'customer.id = orders.customer_id')
            ->where('orders.id', $id)
            ->first();

        if ($order) {
            return $this->response->setJSON(['success' => true, 'data' => $order]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Order not found']);
        }
    }
}
