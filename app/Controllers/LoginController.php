<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

class LoginController extends Controller
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    // View the login page
    public function view()
    {
        return view('login/login');
    }

    // Handle login functionality
    public function login()
    {
        // Get POST data from the form
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');

        // Check if user exists
        $user = $this->loginModel->where('email', $email)->first();

        if ($user) {
            // User exists, check the password
            if (password_verify($password, $user['password'])) {
                // Set session data
                session()->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'is_logged_in' => true
                ]);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Login successful'
                ]);
            } else {
                // Incorrect password
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid credentials (incorrect password)'
                ]);
            }
        } else {
            // User not found
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid credentials (user not found)'
            ]);
        }
    }

    // Handle logout functionality
    public function logout()
    {
        session()->destroy();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Logout successful'
        ]);
    }
}
