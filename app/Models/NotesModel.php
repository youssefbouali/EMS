<?php

namespace App\Models;

use CodeIgniter\Model;

class NotesModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom_etudiant', 'note'];

    // Insérer une nouvelle note
    public function ajouterNote($nomEtudiant, $note)
    {
        return $this->insert([
            'nom_etudiant' => $nomEtudiant,
            'note' => $note
        ]);
    }

    // Récupérer toutes les notes
    public function getNotes()
    {
        return $this->findAll();
    }
}
