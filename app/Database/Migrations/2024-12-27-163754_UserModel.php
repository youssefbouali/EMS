<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
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
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'prenom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            // 'numEtudiant' => [
            //     'type'       => 'VARCHAR',
            //     'constraint' => 50,
            // ],
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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

        // Ajout de la clé primaire
        $this->forge->addKey('id', true);

        // Ajout de la clé étrangère pour la relation avec la table 'role'
        $this->forge->addForeignKey('role_id', 'role', 'id', 'CASCADE', 'CASCADE');

        // Création de la table
        $this->forge->createTable('user');
    }

    public function down()
    {
        // Suppression de la table 'user'
        $this->forge->dropTable('user');
    }
}
