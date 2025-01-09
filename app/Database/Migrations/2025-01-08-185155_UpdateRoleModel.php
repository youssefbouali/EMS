<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateRoleModel extends Migration
{
    public function up()
    {
      // Modify the 'role' table (change column names)
      $this->forge->addColumn('role', [
        'role_name' => [
            'type' => 'VARCHAR',
            'constraint' => '191',
        ],
    ]);

    // Remove old columns 'etudiant' and 'prof'
    $this->forge->dropColumn('role', 'etudiant');
    $this->forge->dropColumn('role', 'prof');
    }

    public function down()
    {
        //
    }
}
