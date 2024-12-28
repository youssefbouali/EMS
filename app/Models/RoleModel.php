<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idAccount', 'etudiant', 'prof'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'etudiant' => 'required|in_list[0,1]',
        'prof' => 'required|in_list[0,1]',
    ];

   
    protected $validationMessages = [
        'etudiant' => [
            'required' => 'Le role est obligatoire.',
        ],
        'prof' => [
            'required' => 'Le role est obligatoire.',
        ],
        
    ];
    //protected $skipValidation = false;
}
