<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   
    protected $table      = 'user';         
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
        //'cne' => 'min_length[3]|max_length[20]',
		//'cin' => 'min_length[3]|max_length[20]',
		//'dateNaissance' => 'min_length[3]',
        
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
        ],/*
        'cne' => [
            'required' => 'Le cne est obligatoire',
            'min_length' => 'Le cne doit avoir au moins 3 caractères',
            'max_length' => 'Le cne ne doit pas dépasser 20 caractères'
        ],
        'cin' => [
            'required' => 'Le cin est obligatoire',
            'min_length' => 'Le cin doit avoir au moins 3 caractères',
            'max_length' => 'Le cin ne doit pas dépasser 20 caractères'
        ],
        'dateNaissance' => [
            'required' => 'Le dateNaissance est obligatoire',
            'min_length' => 'Le dateNaissance doit avoir au moins 3 caractères',
            'max_length' => 'Le dateNaissance ne doit pas dépasser 20 caractères'
        ],*/
        
    ];

   
}