<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        
        if (session()->has('user_id')) {
            return view('dashboard');
        }
        return view('register');
    }
}
