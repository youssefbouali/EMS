<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'note'; 
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

   
    protected $allowedFields = ['session', 'description', 'noteNormal', 'noteRattrapage', 'IdModule', 'IdUserProfessor', 'IdUserStudent'];

    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    
    protected $validationRules = [
        'session' => 'required|string|min_length[3]|max_length[100]|in_list[normal,rattrapage]',
        'description' => 'permit_empty|string|max_length[191]',
        'noteNormal' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[20]',
        'noteRattrapage' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[20]',
    ];

    // Messages de validation personnalisés
    protected $validationMessages = [
        'session' => [
            'required' => 'Le nom de la filière est obligatoire.',
            'min_length' => 'Le nom de la filière doit contenir au moins 3 caractères.',
            'max_length' => 'Le nom de la filière ne peut pas dépasser 100 caractères.',
        ],
        'description' => [
            'max_length' => 'La description ne peut pas dépasser 191 caractères.',
        ],
        'value' => [
            'required' => 'La note est obligatoire.',
        ],
    ];
	

    private $data;
	
    //public function __construct($data = [])
    public function setobject($data = [])
    {
        ////parent::__construct();
	
        $this->data = $data;
    }
	
    public function add()
    {
        if (empty($this->data)) {
            throw new \InvalidArgumentException('No data provided for saving.');
        }
	
        if (!$this->validate($this->data)) {
            return false;
        }
	
        return $this->insert($this->data);
    }
	
    public function getErrors()
    {
        return $this->errors();
    }
}