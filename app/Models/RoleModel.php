<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    #protected $allowedFields = ['idAccount', 'role_name','idUser']; The role already has a foreign key idAccount
    protected $allowedFields = ['idAccount', 'role_name'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'role_name' => 'required|string|in_list[student,professor]',
        #'idUser' => 'required|is_natural_no_zero', // Ensure user_id is provided and valid
    ];

    protected $validationMessages = [
        'role_name' => [
            'required' => 'Le rôle est obligatoire.',
        ],
        #'idUser' => [
        #    'required' => 'L\'ID de l\'utilisateur est obligatoire.',
        #    'is_natural_no_zero' => 'L\'ID de l\'utilisateur doit être un entier valide.',
        #],
    ];
    //protected $skipValidation = false;

    public function getUser()
    {
        #return $this->belongsTo('App\Models\UserModel', 'idUser', 'id');
    }
	

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

    public function role(string $idAccount): bool | array{
		
        $role = $this->where('idAccount', $idAccount)->first();

        if($role !== null ){
			
            return $role;
			
        } else {
			
            return false;
        }
    }
	
    public function getErrors()
    {
        return $this->errors();
    }
}

