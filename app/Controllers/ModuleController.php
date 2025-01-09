<?php

namespace App\Controllers;

use App\Models\ModuleModel;
use CodeIgniter\Controller;

class ModuleController extends Controller
{
    protected $moduleModel;

    public function __construct()
    {
        $this->moduleModel = new ModuleModel();
    }

    // Récupérer et afficher les noms des modules
    public function getModuleNames()
    {
        $modules = $this->moduleModel->select('nom')->findAll(); 
        
        if (empty($modules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Aucun module trouvé.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $modules
        ]);
    }
}