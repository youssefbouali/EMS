<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'account'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idUser', 'email', 'password'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'email' => 'required|valid_email|max_length[191]',
        'password' => 'required|string|min_length[8]',
    ];

   
    protected $validationMessages = [
        'email' => [
            'required' => 'L\'email est obligatoire.',
            'min_length' => 'L\'email doit avoir au moins 6 caractères.',
            'max_length' => 'L\'email ne doit pas dépasser 15 caractères.',
        ],
        
    ];
	
    //protected $skipValidation = false;
}
