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

        if ($request->isAJAX()) {
            $email = $request->getVar('email');
            $password = $request->getVar('password');

            $validationRules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];

            if (!$this->validate($validationRules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $loginModel = new LoginModel();
            $user = $loginModel->where('email', $email)->first();

            if ($user && md5($password) === $user['password']) {
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'logged_in' => true
                ]);
                $response['status'] = true;
                $response['message'] = 'Login successful!';
            } else {
                $response['message'] = 'Invalid email or password!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
