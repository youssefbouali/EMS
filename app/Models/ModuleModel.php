<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table = 'module';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['nom', 'description'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nom' => 'required|min_length[3]|max_length[100]',
        'description' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du module est obligatoire',
            'min_length' => 'Le nom doit avoir au moins 3 caractères',
            'max_length' => 'Le nom ne doit pas dépasser 100 caractères',
        ],
        'description' => [
            'max_length' => 'La description ne doit pas dépasser 255 caractères',
        ],
    ];
}