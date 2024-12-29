<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AccountModel;
use App\Models\RoleModel;

class RegisterController extends BaseController
{
    public function index()
    {
        // Load the registration view
        return view('welcome_message');
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

        if (session()->has('user_id')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Already logged in'
            ]);
        }

        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nom' => 'required|string|max_length[191]',
            'prenom' => 'required|string|max_length[191]',
            'email' => 'required|valid_email|max_length[191]',
            'password' => 'required|min_length[8]',
            'role' => 'required|in_list[0,1]',
            'cne' => 'min_length[3]|max_length[20]',
            'cin' => 'min_length[3]|max_length[20]',
            'dateNaissance' => 'min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return validation errors
            return $this->response->setJSON([
                'status' => 'error',
                'message' => ['errors' => $validation->getErrors()]
            ]);
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

        // Set role-related fields
        $data['prof'] = $data['role'] == 1 ? 1 : 0;
        $data['etudiant'] = $data['role'] == 0 ? 1 : 0;

        // Create the role
        $roleId = $roleModel->insert([
            'idAccount' => $accountId,
            'etudiant' => $data['etudiant'],
            'prof' => $data['prof'],
        ]);

        if ($userId && $accountId && $roleId) {
            session()->set([
                'user_id' => $userId,
                'email' => $data['email'],
                'logged_in' => true
            ]);
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Registration successful'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Registration failed'
        ]);
    }
}