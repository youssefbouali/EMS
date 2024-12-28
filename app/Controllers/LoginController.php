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
		
		if (session()->has('user_id')) {
			return "Already logged in";
			exit();
		}
        
        $accountModel = new AccountModel();

        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        
        if (empty($email) || empty($password)) {
            return redirect()->back()->with('erreur');
        }

        // Check if the user exists based on email (assuming email is unique)
        $user = $accountModel->where('email', $email)->first();

        if (!$user) {
            //return redirect()->back()->with('error', 'User not found.');
			return "error";
        }

        
        if (!password_verify($password, $user['password'])) {
            //return redirect()->back()->with('error', 'Mot de passe incorrect');
			return "Mot de passe incorrect";
        }

        // Set session data (you can store more user data here)
        session()->set([
            'user_id' => $user['id'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        
        //return redirect()->to('/users/Accueil');
		return "Login successful";
    }

    
    public function logout()
    {
		
		if (!session()->has('user_id')) {
			return "Session does not exist";
			exit();
		}
        
        session()->destroy();

       
        //return redirect()->to('/login');
		return "Logout successful";
    }
}