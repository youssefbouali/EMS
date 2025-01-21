<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SectorModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $UserModel = new UserModel();
        $SectorModel = new SectorModel();
        
        if (session()->get('role')=="professor") {
			$data['user'] = $UserModel->getUserById(session()->get('user_id'));
			$data['sector'] = $SectorModel->getSectorByUser(session()->get('user_id'));
			
            return view('dashboardProfessor', $data);
			
        } elseif (session()->get('role')=="student") {
        
			$data['user'] = $UserModel->getUserById(session()->get('user_id'));
			$data['sector'] = $SectorModel->getSectorByStudent(session()->get('user_id'));
			if(!isset($data['sector']["nom"])){
				$data['sector']["nom"] = "";
			}

			return view('dashboardStudent', $data);
			
        }
        return view('register');
    }
}
