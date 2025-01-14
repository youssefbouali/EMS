<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotesModel;

class NotesController extends BaseController
{
    public function index()
    {
        $model = new NotesModel();
        $data['notes'] = $model->getNotes();

        return view('saisir_notes', $data); // Vue avec le formulaire et la liste des notes
    }

    public function saisirNote()
    {
        $notesModel = new NotesModel();
        $userModel = new UserModel();

        $nom = $this->request->getPost('nom');
        $note = $this->request->getPost('note');

        // Vérifier si l'étudiant existe avec le nom
        $etudiant = $userModel->where('nom', $nom)->first(); // Vérification dans la table 'user'

        if ($etudiant) {
            // Si l'étudiant existe, enregistrer la note
            $data = [
                'nom_etudiant' => $nom,
                'note' => $note
            ];

            $notesModel->insert($data);
            return redirect()->to('/notes')->with('success', 'Note saisie avec succès!');
        } else {
            // Si l'étudiant n'existe pas, rediriger avec un message d'erreur
            return redirect()->back()->with('error', "L'étudiant {$nom} n'existe pas.");
        }
    }
    public function modifier($id)
{
    $notesModel = new NotesModel();

    // Trouver la note par ID
    $note = $notesModel->find($id);
    if (!$note) {
        return redirect()->to('/notes')->with('error', 'Note introuvable.');
    }

    // Afficher un formulaire avec les données actuelles pour modification
    return view('modifier_note', ['note' => $note]);
}
public function supprimer($id)
{
    $notesModel = new NotesModel();

    // Supprimer la note par ID
    $notesModel->delete($id);

    return redirect()->to('/notes')->with('success', 'Note supprimée avec succès.');
}

}
