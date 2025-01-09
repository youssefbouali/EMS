<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModuleModel extends Model
{
    protected $table = 'usermodule'; 
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idUser', 'idModule', 'typeRelation'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    
    protected $validationRules = [
        'typeRelation' => 'required|string|in_list[student,professor]',
    ];

    // Messages de validation personnalisés
    protected $validationMessages = [
        'typeRelation' => [
            'required' => 'Le nom de la filière est obligatoire.',
        ],
    ];
}