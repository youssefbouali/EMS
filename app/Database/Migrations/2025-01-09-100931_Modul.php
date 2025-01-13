<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Modul extends Migration
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
                'constraint' => '100',
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'sector_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        // Adding the foreign key constraint
        $this->forge->addForeignKey('sector_id', 'sector', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('modul');
    }

    public function down()
    {
        // Dropping the foreign key constraint before dropping the table
        $this->forge->dropForeignKey('modul', 'modul_filiere_id_foreign');
        $this->forge->dropTable('modul');
    }
}
