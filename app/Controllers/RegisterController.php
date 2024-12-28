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
		
		// Load models
        $userModel = new UserModel();
        $accountModel = new AccountModel();
        $roleModel = new RoleModel();
		
		if (session()->has('user_id')) {
			return "Already logged in";
			exit();
		}

        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nom' => 'required|string|max_length[191]',
            'prenom' => 'required|string|max_length[191]',
            //'numEtudiant' => 'required|string|max_length[50]',
            'email' => 'required|valid_email|max_length[191]',
            'password' => 'required|min_length[8]',
			'role' => 'required|in_list[0,1]',
            //'etudiant' => 'required|in_list[0,1]',
            //'prof' => 'required|in_list[0,1]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return errors
            //return view('register', ['errors' => $validation->getErrors()]);
			return "error";
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
            'idUser' => $userId,
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
		
		if($data['role'] == 0){
			$data['prof'] = 0;
			$data['etudiant'] = 1;
			
		} elseif($data['role'] == 1){
			$data['prof'] = 1;
			$data['etudiant'] = 0;
		}

        // Create the role
        $roleId = $roleModel->insert([
            'idAccount' => $accountId,
            'etudiant' => $data['etudiant'],
            'prof' => $data['prof'],
        ]);

        if ($userId && $accountId && $roleId) {
			
			
			
            //return redirect()->to('/success')->with('message', 'Registration successful');
			return "Registration successful";
			
        }

        //return redirect()->back()->withInput()->with('error', 'Registration failed');
		return "Registration failed";
    }
}
