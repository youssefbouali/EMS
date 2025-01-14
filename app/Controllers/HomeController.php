<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HomeController extends BaseController
{
    // Afficher la page d'accueil
    public function index()
    {
        return view('home'); // Charge la vue home.php
    }
}
