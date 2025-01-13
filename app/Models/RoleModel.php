<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idAccount', 'role_name','user_id'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'role_name' => 'required|string',
        'user_id' => 'required|is_natural_no_zero', // Ensure user_id is provided and valid
    ];

    protected $validationMessages = [
        'role_name' => [
            'required' => 'Le rôle est obligatoire.',
        ],
        'user_id' => [
            'required' => 'L\'ID de l\'utilisateur est obligatoire.',
            'is_natural_no_zero' => 'L\'ID de l\'utilisateur doit être un entier valide.',
        ],
    ];
    //protected $skipValidation = false;

    public function getUser()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id', 'id');
    }
}


