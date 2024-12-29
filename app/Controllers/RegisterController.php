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
			return $this->response->setJSON([
				'status' => 'error',
				'message' => 'Already logged in'
			]);
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
			//'cne' => 'min_length[3]|max_length[20]',
			//'cin' => 'min_length[3]|max_length[20]',
			//'dateNaissance' => 'min_length[3]',
			
            //'etudiant' => 'required|in_list[0,1]',
            //'prof' => 'required|in_list[0,1]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return errors
            //return view('register', ['errors' => $validation->getErrors()]);
			return $this->response->setJSON([
				'status' => 'error',
				'message' => ['errors' => $validation->getErrors()]
			]);
        }

        // Get POST data
        $data = $this->request->getPost();
		
		if (!isset($data['cne'])){
			$data['cne'] = "";
		}
		if (!isset($data['cin'])){
			$data['cin'] = "";
		}
		if (!isset($data['dateNaissance'])){
			$data['dateNaissance'] = "";
		}

        // Create the user
        $userId = $userModel->insert([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
			'cne' => $data['cne'],
			'cin' => $data['cin'],
			'dateNaissance' => $data['dateNaissance'],
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
			
			session()->set([
				'user_id' => $userId,
				'email' => $data['email'],
				'logged_in' => true
			]);
			
            //return redirect()->to('/success')->with('message', 'Registration successful');
			return $this->response->setJSON([
				'status' => 'success',
				'message' => 'Registration successful'
			]);
			
        }

        //return redirect()->back()->withInput()->with('error', 'Registration failed');
		return $this->response->setJSON([
			'status' => 'error',
			'message' => 'Registration failed'
		]);
    }
}
