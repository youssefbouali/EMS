<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\UserModuleModel;
use App\Models\ModuleModel;

class NoteController extends BaseController
{
    public function AddNotes()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

		if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
			header("HTTP/1.1 200 OK");
			exit(0);
		}

		// Instantiate the NoteModel
		$noteModel = new NoteModel();
		$UserModuleModel = new UserModuleModel();

		// Decode the incoming JSON
		$data = json_decode($this->request->getBody(), true);

		// Ensure 'notes' is set in the incoming data
		$notes = isset($data['notes']) ? $data['notes'] : [];

		// Check if there are notes to process
		if (empty($notes)) {
			return "No notes found in the request!";
		}

		// Save each note record
		foreach ($notes as $note) {
			// Add 'idUserProfessor' to each note's data
			if (intval($note['noteNormal']) >= 10 || intval($note['noteRattrapage']) >= 10) {
				$valide = 1;
			} else {
				
				$valide = 0;
			}
			$noteData = [
				'valide' => $valide,
				'noteNormal' => $note['noteNormal'],
				'noteRattrapage' => $note['noteRattrapage'],
				'idModule' => $note['idModule'],
				'idUserProfessor' => session()->get('user_id'), // Professor's ID from session
				'idUserStudent' => $note['idUserStudent'],
			];

			$NoteById = $noteModel->getNoteById($note['idUserStudent'], $note['idModule'], $note['noteNormal'], $note['noteRattrapage']);
			
			if(!isset($NoteById)){
			
				$noteModel->archiveOldNote($note['idUserStudent'], $note['idModule']);
				
				// Insert the note into the database
				$noteModel->setobject($noteData);
				$noteModel->add(); // Or the appropriate method for inserting data
			}
		}

		// Return a response
		return json_encode(['status' => 'success']);
		exit;
	}


    public function notes($id)
    {
        // Instantiate the NoteModel
        $noteModel = new NoteModel();

        // Fetch all notes
        //$notes = $noteModel->findAll();
		if(session()->get('role')=="professor"){
			
			$data['notes'] = $noteModel->getNotesByProfessor(session()->get('user_id'), $id);
			
		} elseif(session()->get('role')=="student"){
			
			$data['notes'] = $noteModel->getNotesByStudent(session()->get('user_id'), $id);
		}
		
		
		$ModuleModel = new ModuleModel();
		$getModuleById = $ModuleModel->getModuleById($id);
		$data['nom'] = $getModuleById["nom"];
		
		$data['id'] = $id;

        // Load the notes view with the data
        return view('notes', $data);
    }

	
    public function index()
    {
        
		return view('saisir_notes'); // Vue avec le formulaire et la liste des notes
    }

    public function saisirNote()
    {
        $notesModel = new NoteModel();
        $userModel = new UserModel();

        $idUserStudent = $this->request->getPost('idUserStudent');
        $noteNormal = $this->request->getPost('noteNormal');

        // Vérifier si l'étudiant existe avec le idUserStudent
        $etudiant = $userModel->where('idUserStudent', $idUserStudent)->first(); // Vérification dans la table 'user'

        if ($etudiant) {
            // Si l'étudiant existe, enregistrer la note
            $data = [
                'idUserStudent' => $idUserStudent,
                'noteNormal' => $noteNormal
            ];

            $notesModel->insert($data);
            return redirect()->to('/notes')->with('success', 'noteNormal saisie avec succès!');
        } else {
            // Si l'étudiant n'existe pas, rediriger avec un message d'erreur
            return redirect()->back()->with('error', "L'étudiant {$nom} n'existe pas.");
        }
    }


     public function getLoggedStudentGrades() {
         $studentId = session()->get('user_id');

         if (!$studentId) {
             return redirect()->to('/login'); // Redirect if no student is logged in
         }

         // Load the necessary models
         $userModel = new \App\Models\UserModel();
         $noteModel = new \App\Models\NoteModel();
         $sectorModel = new \App\Models\SectorModel();

         // Get student data
         $user = $userModel->find($studentId); // Assuming the student data is retrieved by their ID
         $sector = $sectorModel->find($user['sector_id']); // Adjust according to your database schema

         // Get student grades
         $grades = $noteModel->getNotesForStudent($studentId);

         // Pass data to the view
         return view('dashboardStudent', ['user' => $user, 'sector' => $sector, 'grades' => $grades]);
     }




}
