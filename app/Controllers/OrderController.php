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

        $orderModel = new OrderModel();

        foreach ($orderData as $data) {
            $orderModel->insert([
                'customer_id' => $data['customer_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'total' => $data['total']
            ]);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Order submitted successfully']);
    }

    // public function deleteBooking($id)
    // {
    //     $orderModel = new OrderModel();

    //     $order = $orderModel->find($id);
    //     if ($order) {
    //         $orderModel->delete($id);
    //         return $this->response->setJSON(['success' => true, 'message' => 'Order deleted successfully.']);
    //     }

    //     return $this->response->setJSON(['success' => false, 'message' => 'Order not found.']);
    // }
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

    // Method to delete the order
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
}
?>
