<?php

namespace App\Controllers;

use App\Models\ModuleModel;
use App\Models\SectorModel;

class ModuleController extends BaseController
{
    public function modules($id)
    {
        // Initialize the model
        $moduleModel = new ModuleModel();
		
		$data['modules'] = $moduleModel->getModulesBySectorUser(session()->get('user_id'), $id);
		
        $SectorModel = new SectorModel();
		$getSectorById = $SectorModel->getSectorById($id);
		$data['nom'] = $getSectorById["nom"];

        // Pass the data to the view
        return view('modules', $data);
    }
}
