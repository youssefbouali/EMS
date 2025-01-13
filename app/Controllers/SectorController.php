<?php

namespace App\Controllers;

use App\Models\SectorModel;

class SectorController extends BaseController
{
    public function filiere()
    {
        // Initialize the model
        $sectorModel = new \App\Models\SectorModel();

        // Fetch both 'nom' (name) and 'description' from the 'sectors' table
        $data['sectors'] = $sectorModel->select('id , nom, description')->findAll();

        // Pass data to the view
        return view('filiere', $data);
    }
}
