<?php

namespace App\Controllers;

use App\Models\AccountModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    
    // Show the login form
    public function loginForm()
    {
        //return view('login/form'); 
    }

    // Handle user login
    public function login()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            exit(0);
        }
        
        if (session()->has('user_id')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Already logged in'
            ]);
            exit();
        }
        
        $accountModel = new AccountModel();

        // recuperer les valeurs email et password
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // valider  email et password
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $validation->getErrors()
            ]);
        }

        // Check if the user exists based on email (assuming email is unique)
        $user = $accountModel->where('email', $email)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Mot de passe incorrect'
            ]);
        }

        // Set session data (you can store more user data here)
        session()->set([
            'user_id' => $user['id'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Login successful'
        ]);
    }

    public function logout()
    {
        if (!session()->has('user_id')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Session does not exist'
            ]);
            exit();
        }
        
        session()->destroy();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Logout successful'
        ]);
    }
}
