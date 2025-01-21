<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Retourner la vue du dashboard (HTML dans une vue CodeIgniter)
        return view('dashboardStudent');
    }
}
