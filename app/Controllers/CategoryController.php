<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function create()
    {
        return view('category/category');
    }

    public function insert()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'category_name' => 'required|min_length[3]|is_unique[category.category_name]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors(),
            ]);
        }

        $this->categoryModel->save([
            'category_name' => $this->request->getPost('category_name'),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category added successfully!',
        ]);
    }

    public function fetchAll()
    {
        $categories = $this->categoryModel->findAll();
        return $this->response->setJSON($categories);
    }

    public function fetchCategory($id)
    {
        $category = $this->categoryModel->find($id);

        if ($category) {
            return $this->response->setJSON(['success' => true, 'data' => $category]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Category not found.']);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $validation = \Config\Services::validation();

        $rules = [
            'category_name' => "required|min_length[3]|is_unique[category.category_name,id,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $this->categoryModel->update($id, ['category_name' => $this->request->getPost('category_name')]);

        return $this->response->setJSON(['success' => true, 'message' => 'Category updated successfully!']);
    }

    public function delete($id)
    {
        $productModel = new \App\Models\ProductModel();

        // Check if any products are associated with this category
        $associatedProducts = $productModel->where('category_id', $id)->countAllResults();

        if ($associatedProducts > 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Cannot delete this category because it has associated products.',
            ]);
        }

        // Proceed to delete the category if no associated products
        if ($this->categoryModel->find($id)) {
            $this->categoryModel->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Category deleted successfully.',
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Category not found.',
        ]);
    }
}
