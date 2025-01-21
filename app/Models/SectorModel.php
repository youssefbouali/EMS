<?php

namespace App\Models;

use CodeIgniter\Model;

class SectorModel extends Model
{
    protected $table = 'sector'; 
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

   
    protected $allowedFields = ['nom', 'description'];

    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    
    protected $validationRules = [
        'nom' => 'required|string|min_length[3]|max_length[100]',
        'description' => 'permit_empty|string|max_length[255]',
    ];

    // Messages de validation personnalisés
    protected $validationMessages = [
        'name' => [
            'required' => 'Le nom de la filière est obligatoire.',
            'min_length' => 'Le nom de la filière doit contenir au moins 3 caractères.',
            'max_length' => 'Le nom de la filière ne peut pas dépasser 100 caractères.',
        ],
        'description' => [
            'max_length' => 'La description ne peut pas dépasser 255 caractères.',
        ],
    ];


    public function getSectorByUser($idUser) {
		$sectors = $this->db->table($this->table);
    
		$sectors->join('module', 'sector.id = module.idSector');
		
		$sectors->join('usermodule', 'module.id = usermodule.idModule');
		
		$sectors->where('usermodule.idUser', $idUser);
		//$sectors->where('usermodule.type', 'professor');  // Uncomment if needed
		
		$sectors->select('sector.id, sector.nom, sector.description');

		return $sectors->get()->getResultArray();
    }


    public function getSectorByStudent($idUser) {
		// Build the query
		$query = $this->db->table($this->table)
			->join('module', 'sector.id = module.idSector')
			->join('usermodule', 'module.id = usermodule.idModule')
			->where('usermodule.idUser', $idUser)
			// Uncomment if filtering by type is needed
			// ->where('usermodule.type', 'professor')
			->select('sector.id, sector.nom, sector.description')
			->get();

		// Fetch the result as an array
		$sectors = $query->getResultArray();

		// Return the first record or an empty string if none found
		return isset($sectors[0]) ? $sectors[0] : [];
	}

	
	
	
	public function getSectorById($idSector) {
		
        return $this->where('id', $idSector)->first();
    }
}
