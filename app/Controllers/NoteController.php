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

    //public function editNoteForm($id)
    //{
    //    // Instantiate the NoteModel
    //    $noteModel = new NoteModel();
	//
    //    // Fetch the note by ID
    //    $note = $noteModel->find($id);
	//
    //    if (!$note) {
    //        throw new \CodeIgniter\Exceptions\PageNotFoundException("Note not found");
    //    }
	//
    //    // Load the edit note view with the data
    //    return view('edit_note_form', ['note' => $note]);
    //}

    //public function updateNote()
    //{
    //    header("Access-Control-Allow-Origin: *");
    //    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    //    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	//
    //    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    //        header("HTTP/1.1 200 OK");
    //        exit(0);
    //    }
	//
    //    // Instantiate the NoteModel
    //    $noteModel = new NoteModel();
	//
    //    // Validate the request
    //    $validation = \Config\Services::validation();
    //    $validation->setRules($noteModel->getValidationRules());
	//
    //    if (!$validation->withRequest($this->request)->run()) {
    //        // Return validation errors
    //        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    //    }
	//
    //    // Get POST data
    //    $data = $this->request->getPost();
	//
    //    // Update the note
    //    $updated = $noteModel->update($data['id'], [
    //        'session' => $data['session'],
    //        //'description' => $data['description'] ?? null,
    //        'noteNormal' => $data['noteNormal'],
    //        'noteRattrapage' => $data['noteRattrapage'],
    //        'IdModule' => $data['IdModule'],
    //        'IdUserProfessor' => $data['IdUserProfessor'],
    //        'IdUserStudent' => $data['IdUserStudent'],
    //    ]);
	//
    //    if ($updated) {
    //        // Redirect with success message
    //        return redirect()->to('/notes')->with('success', 'Note updated successfully!');
    //    } else {
    //        // Redirect with error message
    //        return redirect()->back()->with('error', 'Failed to update note')->withInput();
    //    }
    //}
	//
    //public function deleteNote($id)
    //{
    //    // Instantiate the NoteModel
    //    $noteModel = new NoteModel();
	//
    //    // Delete the note by ID
    //    if ($noteModel->delete($id)) {
    //        return redirect()->to('/notes')->with('success', 'Note deleted successfully!');
    //    } else {
    //        return redirect()->back()->with('error', 'Failed to delete note');
    //    }
    //}
	
	
	
	
	
	
	
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
}
