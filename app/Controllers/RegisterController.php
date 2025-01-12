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

        // Get POST data
        $data = $this->request->getPost();
        $data['cne'] = $data['cne'] ?? "";
        $data['cin'] = $data['cin'] ?? "";
        $data['dateNaissance'] = $data['dateNaissance'] ?? "";

        $userData = [
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'cne' => $data['cne'],
            'cin' => $data['cin'],
            'dateNaissance' => $data['dateNaissance'],
        ];

		$accountData = [
            //'idUser' => $userId,
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ];
		
		$roleData = [
            //'idAccount' => $accountId,
            'role_name' => $data['role_name'],
        ];
		
		

        // Load models
        $userModel = new UserModel();
        $accountModel = new AccountModel();
        $roleModel = new RoleModel();
		

        // Validate the request
        $validation = \Config\Services::validation();
		
		
		$validationRules = array_merge(
			$userModel->getValidationRules(),
			$accountModel->getValidationRules(),
			$roleModel->getValidationRules(),
			[
				'confirmPassword' => 'required|min_length[8]|matches[password]',
			],
		);
		
        //$validation->setRules($validationRules);
		
        if (!$validation->setRules($validationRules)->run($this->request->getPost())) {
            // Return validation errors
            // return $this->response->setJSON([
                // 'status' => 'error',
                // 'message' => ['errors' => $validation->getErrors()]
            // ]);
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
		
		
		
		

        // Create the user
        //$userId = $userModel->insert($userData);
        $userObject = $userModel->setobject($userData);
        $userId = $userModel->add();

		$accountData["idUser"] = $userId;
        $accountObject = $accountModel->setobject($accountData);
        $accountId = $accountModel->add();
        //$accountId = $accountModel->insert($accountData);
		
		
		$roleData["idAccount"] = $accountId;
        // Create the role
        //$roleId = $roleModel->insert($roleData);
        $roleObject = $roleModel->setobject($roleData);
        $roleId = $roleModel->add();
		
		

       if ($userId && $accountId && $roleId) {
           //session()->set([
           //    'user_id' => $userId,
           //    'email' => $data['email'],
           //    'role' => $data['role'],
           //    'logged_in' => true
           //]);
           // Redirection vers la page de connexion en cas de succès
           return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
       } else {
           // Rester sur la même page avec un message d'erreur
           return redirect()->back()->with('error', 'Registration failed')->withInput();
       }


    }
}