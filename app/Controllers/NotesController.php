<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotesModel;

class NotesController extends BaseController
{
   // NotesController.php
public function index()
{
    // Récupérer les notes (aucune restriction basée sur le rôle)
    $model = new NotesModel();
    $data['notes'] = $model->getNotes();
    
    return view('saisir_notes', $data); // Vue pour afficher les notes
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
