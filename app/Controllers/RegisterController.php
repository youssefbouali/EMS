<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AccountModel;
use App\Models\RoleModel;

class RegisterController extends BaseController
{
    public function RegisterForm()
    {
        // Load the registration view
        return view('register');
    }

    public function register()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            exit(0);
        }

        // Load models
        $userModel = new UserModel();
        $accountModel = new AccountModel();
        $roleModel = new RoleModel();

        // if (session()->has('user_id')) {
        //     return $this->response->setJSON([
        //         'status' => 'error',
        //         'message' => 'Already logged in'
        //     ]);
        // }
        
        if (session()->has('user_id')) {
            return redirect()->to('/');
        }

        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nom' => 'required|string|max_length[191]',
            'prenom' => 'required|string|max_length[191]',
            'email' => 'required|valid_email|max_length[191]',
            'password' => 'required|min_length[8]',
            'confirmPassword' => 'required|min_length[8]|matches[password]',
            'role' => 'required|string',
            'cne' => 'permit_empty|min_length[3]|max_length[20]',
            'cin' => 'permit_empty|min_length[3]|max_length[20]',
            'dateNaissance' => 'permit_empty|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return validation errors
            // return $this->response->setJSON([
                // 'status' => 'error',
                // 'message' => ['errors' => $validation->getErrors()]
            // ]);
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get POST data
        $data = $this->request->getPost();
        $data['cne'] = $data['cne'] ?? "";
        $data['cin'] = $data['cin'] ?? "";
        $data['dateNaissance'] = $data['dateNaissance'] ?? "";

        // Create the user
        $userId = $userModel->insert([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'cne' => $data['cne'],
            'cin' => $data['cin'],
            'dateNaissance' => $data['dateNaissance'],
        ]);

        // Create the account
        $accountId = $accountModel->insert([
            'idUser' => $userId,
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        $role = $data['role'];

        // Create the role
        $roleId = $roleModel->insert([
            'idAccount' => $accountId,
            'role_name' => $role,
        ]);

       if ($userId && $accountId && $roleId) {
           session()->set([
               'user_id' => $userId,
               'email' => $data['email'],
               'logged_in' => true
           ]);
           // Redirection vers la page de connexion en cas de succès
           return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
       } else {
           // Rester sur la même page avec un message d'erreur
           return redirect()->back()->with('error', 'Registration failed')->withInput();
       }


    }
}