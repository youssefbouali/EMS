<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idAccount', 'role_name'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'role_name' => 'required|string',
    ];

    protected $validationMessages = [
        'role_name' => [
            'required' => 'Le rôle est obligatoire.',
        ],
    ];
    //protected $skipValidation = false;
}
