<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotesModel;

class NotesController extends BaseController
{
    public function index()
    {
        
		if(session()->get('role')=="professor"){
			$data['notes'] = $noteModel->where('idUserProfessor', session()->get('user_id'))->where('idModule', $id)->findAll();
		} elseif(session()->get('role')=="student"){
			$data['notes'] = $noteModel->where('idUserStudent', session()->get('user_id'))->where('idModule', $id)->findAll();
		}

        return view('saisir_notes', $data); // Vue avec le formulaire et la liste des notes
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
