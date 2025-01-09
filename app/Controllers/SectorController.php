<?php

namespace App\Controllers;

use App\Models\SectorModel;

class SectorController extends BaseController
{
    // Méthode qui retourne les noms des filières
    public function getSectors()
    {
        // Charger le modèle SectorModel
        $sectorModel = new SectorModel();

        // Récupérer les noms des filières
        $sectors = $sectorModel->select('nom')->findAll();

        // Retourner les noms sous forme de JSON
        return $this->response->setJSON($sectors);
    }
}