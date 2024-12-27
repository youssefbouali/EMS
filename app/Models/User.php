<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true; // Auto-increment for the primary key
    protected $returnType = 'array'; // Data return type

    // Fields allowed for mass assignment
    protected $allowedFields = ['nom', 'prenom', 'numEtudiant'];

    // Timestamps if needed
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules (optional)
    protected $validationRules = [
        'nom' => 'required|string|max_length[255]',
        'prenom' => 'required|string|max_length[255]',
        'numEtudiant' => 'required|string|max_length[50]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
