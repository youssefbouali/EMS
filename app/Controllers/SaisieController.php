<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SaisieController extends Controller
{
    public function ingenierie()
    {
        return view('ingenierie'); // Loads the ingenierie.php view
    }

    public function intelligence()
    {
        return view('intelligence'); // Loads the intelligence.php view
    }

    public function systeme()
    {
        return view('systeme'); // Loads the systeme.php view
    }
}
