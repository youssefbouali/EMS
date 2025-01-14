<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AccountModel;
use App\Models\RoleModel;

class RegisterController extends BaseController
{
    public function registerForm()
    {
        // Charger la vue d'inscription
        return view('register');
    }

    public function register()
    {
        // Configurer les en-têtes CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            exit(0);
        }

        // Vérifier si l'utilisateur est déjà connecté
        if (session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'Already logged in');
        }

        // Récupération des données POST
        $data = $this->request->getPost();
        $data['cne'] = $data['cne'] ?? "";
        $data['cin'] = $data['cin'] ?? "";
        $data['dateNaissance'] = $data['dateNaissance'] ?? "";

        // Préparation des données pour chaque modèle
        $userData = [
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'cne' => $data['cne'],
            'cin' => $data['cin'],
            'dateNaissance' => $data['dateNaissance'],
        ];

        $accountData = [
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ];

        $roleData = [
            'role_name' => $data['role_name'],
        ];

        // Initialisation des modèles
        $userModel = new UserModel();
        $accountModel = new AccountModel();
        $roleModel = new RoleModel();

        // Validation des données
        $validation = \Config\Services::validation();
        $validationRules = array_merge(
            $userModel->getValidationRules(),
            $accountModel->getValidationRules(),
            $roleModel->getValidationRules(),
            ['confirmPassword' => 'required|min_length[8]|matches[password]']
        );

        if (!$validation->setRules($validationRules)->run($data)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Insérer les données dans la base
        try {
            //$userId = $userModel->insert($userData);
            //$accountData['idUser'] = $userId;
            //$accountId = $accountModel->insert($accountData);
			//
            //$roleData['idAccount'] = $accountId;
            //$roleData['user_id'] = $userId;
            //$roleId = $roleModel->insert($roleData);
			
			// Create the user
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
                return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
            } else {
                return redirect()->back()->with('error', 'Registration failed')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
