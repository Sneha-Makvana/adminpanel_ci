<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

class LoginController extends Controller
{
    public function create()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/admin');
        }

        return view('login/login', ['isLoginPage' => true]);
    }

    public function login()
    {
        $response = ['status' => false, 'message' => ''];
        $request = $this->request;

        // Check if the request is an AJAX call
        if ($request->isAJAX()) {
            $email = $request->getPost('email');
            $password = $request->getVar('password');

            // Validation rules for email and password
            $validationRules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];

            // Validate input data
            if (!$this->validate($validationRules)) {
                // If validation fails, return errors
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            // Initialize LoginModel to check user credentials
            $loginModel = new LoginModel();
            $user = $loginModel->where('email', $email)->first();

            // Check if user exists and password matches
            if ($user && md5($password) === $user['password']) {
                // If successful, create session
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'logged_in' => true
                ]);
                $response['status'] = true;
                $response['message'] = 'Login successful!';
            } else {
                // If credentials are wrong, return a specific error message
                $response['message'] = 'Invalid email or password!';
            }
        }

        // Return the response as JSON
        return $this->response->setJSON($response);
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
