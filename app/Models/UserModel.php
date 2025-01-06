<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['nom', 'prenom', 'cne', 'cin', 'dateNaissance'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nom' => 'required|min_length[3]|max_length[100]',
        'prenom' => 'required|min_length[3]|max_length[100]',
        'cne' => 'permit_empty|min_length[3]|max_length[20]',
        'cin' => 'permit_empty|min_length[3]|max_length[20]',
        'dateNaissance' => 'permit_empty|min_length[3]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit avoir au moins 3 caractères',
            'max_length' => 'Le nom ne doit pas dépasser 100 caractères',
        ],
        'prenom' => [
            'required' => 'Le prénom est obligatoire',
            'min_length' => 'Le prénom doit avoir au moins 3 caractères',
            'max_length' => 'Le prénom ne doit pas dépasser 100 caractères',
        ],
        'cne' => [
            'min_length' => 'Le CNE doit avoir au moins 3 caractères',
            'max_length' => 'Le CNE ne doit pas dépasser 20 caractères',
        ],
        'cin' => [
            'min_length' => 'Le CIN doit avoir au moins 3 caractères',
            'max_length' => 'Le CIN ne doit pas dépasser 20 caractères',
        ],
        'dateNaissance' => [
            'min_length' => 'La date de naissance doit avoir au moins 3 caractères',
        ],
    ];
}