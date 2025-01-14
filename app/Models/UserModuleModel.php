<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModuleModel extends Model
{
    protected $table = 'usermodule'; 
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idUser', 'idModule', 'type'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    
    protected $validationRules = [
        'type' => 'required|string|in_list[student,professor]',
    ];

    // Messages de validation personnalisés
    protected $validationMessages = [
        'type' => [
            'required' => 'Le nom de la filière est obligatoire.',
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