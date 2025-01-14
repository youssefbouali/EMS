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
    public function modifier($id)
{
    $model = new NotesModel();

    // Récupérer la note par son ID
    $data['note'] = $model->find($id);

    if (!$data['note']) {
        // Si la note n'existe pas, afficher un message d'erreur
        return redirect()->to('/notes')->with('error', 'La note n\'existe pas.');
    }

    // Afficher la vue pour modifier la note
    return view('modifier_note', $data);
}
public function modifierNote($id)
{
    $model = new NotesModel();

    // Récupérer la nouvelle note du formulaire
    $note = $this->request->getPost('note');

    // Vérifier que la note est valide (entre 0 et 20)
    if ($note < 0 || $note > 20) {
        return redirect()->back()->with('error', 'La note doit être entre 0 et 20.');
    }

    // Mettre à jour la note dans la base de données
    $data = [
        'note' => $note
    ];

    if ($model->update($id, $data)) {
        // Si la mise à jour est réussie, rediriger avec un message de succès
        return redirect()->to('/notes')->with('success', 'La note a été modifiée avec succès.');
    } else {
        // En cas d'erreur, rediriger avec un message d'erreur
        return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la note.');
    }
}

public function supprimer($id)
{
    $notesModel = new NotesModel();

    // Supprimer la note par ID
    $notesModel->delete($id);

    return redirect()->to('/notes')->with('success', 'Note supprimée avec succès.');
}

}
