<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   
    protected $table      = 'users';         
    protected $primaryKey = 'id';             

    
    protected $allowedFields = ['nom', 'prenom', 'email'];

    
    protected $validationRules = [
        'nom' => 'required|min_length[3]|max_length[100]',
        'prenom' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|min_length[6]|max_length[15]'
        
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
        'email' => [
            'required' => 'L email est obligatoire.',
            'min_length' => 'L email doit avoir au moins 6 caractères.',
            'max_length' => 'L email ne doit pas dépasser 15 caractères.',
        ],
        
    ];

   
}