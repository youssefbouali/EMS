<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    // Update the table name to 'modul'
    protected $table      = 'modul';
    protected $primaryKey = 'id';

    // Define the allowed fields
    protected $allowedFields = ['nom', 'description', 'sector_id'];

    // Define the timestamps if necessary
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Define validation rules (if necessary)
    protected $validationRules = [
        'nom' => 'required|string|max_length[100]',
        'sector_id' => 'required|integer',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'The module name is required.',
            'string'   => 'The module name must be a string.',
        ],
        'sector_id' => [
            'required' => 'The sector ID is required.',
            'integer'  => 'The sector ID must be an integer.',
        ],
    ];
}
