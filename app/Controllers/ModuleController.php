<?php

namespace App\Controllers;

use App\Models\ModuleModel;

class ModuleController extends BaseController
{
    public function index($id)
    {
        // Initialize the model
        $moduleModel = new \App\Models\ModuleModel();

        // Fetch modules for the selected filiere using the filiere_id
        $data['modules'] = $moduleModel->where('sector_id', $id)->findAll();

        // Pass the data to the view
        return view('module', $data);
    }
}
