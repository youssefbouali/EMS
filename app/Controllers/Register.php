<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AccountModel;
use App\Models\RoleModel;

class Register extends BaseController
{
    public function index()
    {
        // Load the registration view
        return view('welcome_message');
    }

    public function register()
    {
        // Load models
        $userModel = new UserModel();
        $accountModel = new AccountModel();
        $roleModel = new RoleModel();

        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nom' => 'required|string|max_length[255]',
            'prenom' => 'required|string|max_length[255]',
            //'numEtudiant' => 'required|string|max_length[50]',
            'email' => 'required|valid_email|max_length[255]',
            'password' => 'required|min_length[8]',
            'etudiant' => 'required|in_list[0,1]',
            'prof' => 'required|in_list[0,1]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return errors
            //return view('register', ['errors' => $validation->getErrors()]);
        }

        // Get POST data
        $data = $this->request->getPost();

        // Create the user
        $userId = $userModel->insert([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            //'numEtudiant' => $data['numEtudiant'],
        ]);

        // Create the account
        $accountId = $accountModel->insert([
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        // Create the role
        $roleId = $roleModel->insert([
            'etudiant' => (bool)$data['etudiant'],
            'prof' => (bool)$data['prof'],
        ]);

        if ($userId && $accountId && $roleId) {
            return redirect()->to('/success')->with('message', 'Registration successful');
        }

        return redirect()->back()->withInput()->with('error', 'Registration failed');
    }
}
