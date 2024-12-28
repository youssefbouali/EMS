<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   
    protected $table      = 'user';         
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';      

    
    protected $allowedFields = ['nom', 'prenom'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    
    protected $validationRules = [
        'nom' => 'required|min_length[3]|max_length[100]',
        'prenom' => 'required|min_length[3]|max_length[100]'
        
    ];

   
    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit avoir au moins 3 caractères',
            'max_length' => 'Le nom ne doit pas dépasser 100 caractères'
        ],
        'prenom' => [
            'required' => 'Le prénom est obligatoire',
            'min_length' => 'Le prénom doit avoir au moins 3 caractères',
            'max_length' => 'Le prénom ne doit pas dépasser 100 caractères'
        ],
        
    ];

   
}