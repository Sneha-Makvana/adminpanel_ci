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
        $categoryModel = new CategoryModel();
        $category = $categoryModel->findAll();

        return view('product/product', ['category' => $category]);
    }

    public function view()
    {
        return view('product/view');
    }

    public function insert()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[5]',
            'quantity' => 'required',
            'size' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'product_image' => 'uploaded[product_image]|max_size[product_image,2048]|is_image[product_image]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $productModel = new ProductModel();

        $productImages = $this->request->getFileMultiple('product_image');

        if ($productImages && is_array($productImages)) {
            $productImageNames = [];

            foreach ($productImages as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $imageName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/uploads/events/', $imageName);
                    $productImageNames[] = $imageName;
                }
            }
        } else {
            $productImageNames = [];
        }


        $productModel->save([
            'product_name' => $this->request->getVar('product_name'),
            'description' => $this->request->getVar('description'),
            'quantity' => $this->request->getVar('quantity'),
            'size' => $this->request->getVar('size'),
            'price' => $this->request->getVar('price'),
            'category_id' => $this->request->getVar('category'),
            'product_image' => implode(',', $productImageNames),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Product added successfully!'
        ]);
    }

    public function fetchProduct($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if ($product) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $product
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'product not found.'
        ]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        if (!$product) {
            return $this->response->setJSON(['success' => false, 'message' => 'Product not found.']);
        }

        // Validation rules
        $validation = \Config\Services::validation();
        $rules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[5]',
            'quantity' => 'required',
            'size' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'product_image' => 'uploaded[product_image]|max_size[product_image,2048]|is_image[product_image]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $eventData = [
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'quantity' => $this->request->getPost('quantity'),
            'size' => $this->request->getPost('size'),
            'price' => $this->request->getPost('price'),
            'category_id' => $this->request->getPost('category'),
        ];

        // Handle product images
        $productImages = $this->request->getFileMultiple('product_image');
        $productImageNames = [];

        // If there are any new images uploaded
        if (!empty($productImages)) {
            foreach ($productImages as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $imageName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/uploads/events/', $imageName);
                    $productImageNames[] = $imageName;
                }
            }
        }

        // If there are existing images, append the new ones
        if (!empty($productImageNames)) {
            $existingImages = explode(',', $product['product_image']);
            $eventData['product_image'] = implode(',', array_merge($existingImages, $productImageNames));
        }

        // If no new images, just keep the existing ones
        if (empty($productImageNames) && !empty($product['product_image'])) {
            $eventData['product_image'] = $product['product_image'];
        }

        // Update product
        $productModel->update($id, $eventData);

        return $this->response->setJSON(['success' => true, 'message' => 'Product updated successfully.']);
    }




    public function fetchAll()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $events = $productModel->findAll();
        foreach ($events as &$event) {
            $category = $categoryModel->find($event['category_id']);
            $event['category_name'] = $category ? $category['category_name'] : 'Unknown';
        }

        return $this->response->setJSON($events);
    }


    public function delete($id)
    {
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $product = $productModel->find($id);
        if (!$product) {
            return $this->response->setJSON(['success' => false, 'message' => 'Product not found.']);
        }

        $orders = $orderModel->where('product_id', $id)->findAll();
        if (count($orders) > 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Cannot delete Product because there are Orders associated with it.']);
        }

        $productModel->delete($id);
        return $this->response->setJSON(['success' => true, 'message' => 'Product deleted successfully.']);
    }

    public function display()
    {
        return view('event/profile');
    }
    public function details($id)
    {
        $productModel = new ProductModel();

        $product = $productModel->find($id);

        if ($product) {
            $product['image_url'] = base_url('uploads/events/' . $product['event_images']);

            return $this->response->setJSON($product);
        } else {
            return $this->response->setJSON(['error' => 'Customer not found'], 404);
        }
    }
}
