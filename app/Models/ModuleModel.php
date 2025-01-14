<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table      = 'module';
    protected $primaryKey = 'id';

    // Define the allowed fields
    protected $allowedFields = ['nom', 'description', 'idSector'];

    // Define the timestamps if necessary
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Define validation rules (if necessary)
    protected $validationRules = [
        'nom' => 'required|string|max_length[100]',
        'idSector' => 'required|integer',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'The module name is required.',
            'string'   => 'The module name must be a string.',
        ],
        'idSector' => [
            'required' => 'The sector ID is required.',
            'integer'  => 'The sector ID must be an integer.',
        ],
    ];


    public function getModulesBySectorUser($idUser, $idSector) {
		$modules = $this->db->table($this->table);
        $modules->join('usermodule', 'module.id = usermodule.idModule');
        $modules->where('module.idSector', $idSector);
        $modules->where('usermodule.idUser', session()->get('user_id'));
        //$modules->where('usermodule.type', 'professor');
        
        // Get the result as an array
        return $modules->get()->getResultArray();
    }

    public function getModuleById($idModule) {
		
        return $this->where('id', $idModule)->first();
    }

    
}
