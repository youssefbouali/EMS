<?php

namespace App\Controllers;

use App\Models\SectorModel;

class SectorController extends BaseController
{
    public function sectors()
    {
        // Initialize the model
        $sectorModel = new \App\Models\SectorModel();
		
		$data['sectors'] = $sectorModel->getSectorByUser(session()->get('user_id'));


        return view('sectors', $data);
    }
}
