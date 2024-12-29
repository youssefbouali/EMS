<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    
    // Show the login form
    public function loginForm()
    {
        return view('login/form'); 
    }

    // Handle user login
    public function login()
    {
        
        $compteModel = new CompteModel();

        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        
        if (empty($email) || empty($password)) {
            return redirect()->back()->with('erreur');
        }

        /* Check if the user exists based on email (assuming email is unique)
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }*/

        
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Mot de passe incorrect');
        }

        // Set session data (you can store more user data here)
        session()->set([
            'user_id' => $user['id'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        
        return redirect()->to('/users/Accueil'); 
    }

    
    public function logout()
    {
        
        session()->destroy();

       
        return redirect()->to('/login');
    }
}
