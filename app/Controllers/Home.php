<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        
        if (session()->get('role')=="professor") {
            return view('dashboardProfessor');
			
        } elseif (session()->get('role')=="student") {
            return view('dashboardStudent');
        }
        return view('register');
    }
}
