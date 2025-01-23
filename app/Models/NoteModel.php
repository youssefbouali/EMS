<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModuleModel;

class NoteModel extends Model
{
    protected $table = 'note'; 
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

   
    protected $allowedFields = ['valide', /*'description',*/ 'noteNormal', 'noteRattrapage', 'idModule', 'idUserProfessor', 'idUserStudent', 'archive'];

    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    
    protected $validationRules = [
        #'session' => 'required|strin
    ];

    // Messages de validation personnalisés
    protected $validationMessages = [
        #'session' => [
        #    'required' => 'Le nom de la filière est obligatoire.',
        #    'min_length' => 'Le nom de la filière doit contenir au moins 3 caractères.',
        #    'max_length' => 'Le nom de la filière ne peut pas dépasser 100 caractères.',
        #],
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
	
	
	public function getNotesByProfessor($idUser, $idModule) {
		$UserModuleModel = new UserModuleModel();

		// Start with the 'usermodule' table
		$profile = $this->db->table('usermodule');

		// Perform LEFT JOIN with 'note' table
		$profile->join('note', 'note.idUserStudent = usermodule.idUser AND note.idModule = usermodule.idModule AND note.idUserProfessor = ' . $idUser, 'left'); 

		// Perform LEFT JOIN with 'user' table
		$profile->join('user', 'user.id = usermodule.idUser', 'left');

		// Add condition for the module and type
		$profile->where('usermodule.type', "student");
		$profile->where('usermodule.idModule', $idModule);
		$profile->where('note.archive', null);
		
		$profile->select('usermodule.idUser AS idUserStudent, usermodule.idModule AS idModule, 
                      note.id AS noteId, note.noteNormal, note.noteRattrapage, note.valide, 
                      user.prenom, user.nom, user.cne');


		// Execute and return the results
		return $profile->get()->getResultArray();
	}



    /*public function getNotesForLoggedStudent($idUser) {
        
        $profile = $this->db->table($this->table);
        
        $profile->join('user', 'note.idUserStudent = user.id');
        
        $profile->join('module', 'note.idModule = module.id'); 
        
        $profile->where('note.idUserStudent', $idUser);
        $profile->where('note.archive', null);
    
        $profile->select('module.name AS moduleName, note.noteNormal, note.noteRattrapage, note.valide, user.prenom, user.nom');
    
        return $profile->get()->getResultArray();
    }*/


    public function getNotesForStudent($studentId)
    {
        // Assuming 'notes' table has columns like 'idUserStudent', 'idModule', 'noteNormal', 'noteRattrapage', 'valide'
        $query = $this->db->table('note')
                          ->join('modules', 'module.id = note.idModule')
                          ->where('note.idUserStudent', $studentId)
                          ->get();

        return $query->getResultArray();
    }

	
	/*public function getNoteById($idUser, $idModule, $noteNormal, $noteRattrapage) {
		
        return $this->where(['idUserStudent' => $idUser, 'idModule' => $idModule, 'noteNormal' => $noteNormal, 'noteRattrapage' => $noteRattrapage])->first();

	}*/

    public function archiveOldNote($idUser, $idModule) {
		
        return $this->where(['idUserStudent' => $idUser, 'idModule' => $idModule])
                    ->set(['archive' => 1])
                    ->update();

	}


    public function getNotesByModule($idModule) {
        return $this->where('idModule', $idModule)->findAll();
    }


    public function getNoteByStudentModule($idUser, $idModule){
        return $this->where(['idUser' => $idUser, 'idModule' => $idModule])->findAll();
    }


    public function getNotesForLoggedStudent($studentId)
    {
        // Query to get the student's grades along with module names
        return $this->db->table('note')
            ->select('note.idModule, module.nom AS moduleName, note.noteNormal, note.noteRattrapage, note.valide')
            ->join('module', 'module.id = note.idModule')
            ->where('note.idUserStudent', $studentId)
            ->get()
            ->getResult(); // or getResult() if using CodeIgniter 4
    }

    public function getErrors()
    {
        return $this->errors();
    }
}