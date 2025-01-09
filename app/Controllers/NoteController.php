<?php

namespace App\Controllers;

use App\Models\NoteModel;

class NoteController extends BaseController
{
    public function noteForm()
    {
        // Load the note creation view
        return view('note');
    }

    public function createNote()
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

        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules($noteModel->getValidationRules());

        if (!$validation->withRequest($this->request)->run()) {
            // Return validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get POST data
        $data = $this->request->getPost();

        // Insert the note
        $noteId = $noteModel->insert([
            'session' => $data['session'],
            'description' => $data['description'] ?? null,
            'noteNormal' => $data['noteNormal'],
            'noteRattrapage' => $data['noteRattrapage'],
            'IdModule' => $data['IdModule'],
            'IdUserProfessor' => $data['IdUserProfessor'],
            'IdUserStudent' => $data['IdUserStudent'],
        ]);

        if ($noteId) {
            // Redirect with success message
            return redirect()->to('/notes')->with('success', 'Note created successfully!');
        } else {
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to create note')->withInput();
        }
    }

    public function listNotes()
    {
        // Instantiate the NoteModel
        $noteModel = new NoteModel();

        // Fetch all notes
        $notes = $noteModel->findAll();

        // Load the notes view with the data
        return view('list_notes', ['notes' => $notes]);
    }

    public function editNoteForm($id)
    {
        // Instantiate the NoteModel
        $noteModel = new NoteModel();

        // Fetch the note by ID
        $note = $noteModel->find($id);

        if (!$note) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Note not found");
        }

        // Load the edit note view with the data
        return view('edit_note_form', ['note' => $note]);
    }

    public function updateNote()
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

        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules($noteModel->getValidationRules());

        if (!$validation->withRequest($this->request)->run()) {
            // Return validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get POST data
        $data = $this->request->getPost();

        // Update the note
        $updated = $noteModel->update($data['id'], [
            'session' => $data['session'],
            'description' => $data['description'] ?? null,
            'noteNormal' => $data['noteNormal'],
            'noteRattrapage' => $data['noteRattrapage'],
            'IdModule' => $data['IdModule'],
            'IdUserProfessor' => $data['IdUserProfessor'],
            'IdUserStudent' => $data['IdUserStudent'],
        ]);

        if ($updated) {
            // Redirect with success message
            return redirect()->to('/notes')->with('success', 'Note updated successfully!');
        } else {
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update note')->withInput();
        }
    }

    public function deleteNote($id)
    {
        // Instantiate the NoteModel
        $noteModel = new NoteModel();

        // Delete the note by ID
        if ($noteModel->delete($id)) {
            return redirect()->to('/notes')->with('success', 'Note deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete note');
        }
    }
}
