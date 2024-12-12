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

    public function insert()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[customer.email]',
            'gender' => 'required|in_list[male,female]',
            'address' => 'required|min_length[5]',
            'city' => 'required',
            'phone_no' => 'required|exact_length[10]|numeric',
            'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }


        $customerModel = new \App\Models\CustomerModel();

        $profileImage = $this->request->getFile('profile_image');
        $profileImageName = null;

        if ($profileImage && $profileImage->isValid() && !$profileImage->hasMoved()) {
            $profileImageName = $profileImage->getRandomName();
            $profileImage->move(ROOTPATH . 'public/uploads/customers/', $profileImageName);
        }
        $customerModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'phone_no' => $this->request->getPost('phone_no'),
            'profile_image' => $profileImageName,
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Customer added successfully!'
        ]);
    }

    public function fetchAll()
    {
        $customerModel = new \App\Models\CustomerModel();
        $customers = $customerModel->findAll();

        return $this->response->setJSON($customers);
    }

    public function delete($id)
    {
        $customerModel = new \App\Models\CustomerModel();
        $bookingModel = new \App\Models\BookingModel();

        $customer = $customerModel->find($id);
        if (!$customer) {
            return $this->response->setJSON(['success' => false, 'message' => 'Customer not found.']);
        }

        $bookings = $bookingModel->where('customer_id', $id)->findAll();
        if (count($bookings) > 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Cannot delete Customer because there are bookings associated with it.']);
        }

        $customerModel->delete($id);
        return $this->response->setJSON(['success' => true, 'message' => 'Customer deleted successfully.']);
    }


    public function fetchCustomer($id)
    {
        $customerModel = new \App\Models\CustomerModel();
        $customer = $customerModel->find($id);

        if ($customer) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $customer
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Customer not found.'
        ]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|max_length[255]',
            'gender' => 'required|in_list[male,female]',
            'address' => 'required|min_length[5]',
            'city' => 'required',
            'phone_no' => 'required|exact_length[10]|numeric',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $customerModel = new \App\Models\CustomerModel();

        $profileImage = $this->request->getFile('profile_image');
        $profileImageName = null;

        if ($profileImage && $profileImage->isValid() && !$profileImage->hasMoved()) {
            $profileImageName = $profileImage->getRandomName();
            $profileImage->move(ROOTPATH . 'public/uploads/customers/', $profileImageName);
        } else {
            $profileImageName = $this->request->getPost('existing_profile_image');
        }

        $customerModel->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'phone_no' => $this->request->getPost('phone_no'),
            'profile_image' => $profileImageName,
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Customer updated successfully.']);
    }

    public function display()
    {
        return view('customer/profile');
    }
    public function details($id)
    {
        $customerModel = new \App\Models\CustomerModel();
        $customer = $customerModel->find($id);

        if ($customer) {
            $customer['image_url'] = base_url('uploads/customers/' . $customer['profile_image']);

            return $this->response->setJSON($customer);
        } else {
            return $this->response->setJSON(['error' => 'Customer not found'], 404);
        }
    }
}
