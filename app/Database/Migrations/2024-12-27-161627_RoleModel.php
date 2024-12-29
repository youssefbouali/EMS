<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'idAccount' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'etudiant' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'prof' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('role');
		// Ajout de la clé étrangère pour la relation avec la table 'role'
        $this->forge->addForeignKey('idAccount', 'account', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('role');
    }
}
