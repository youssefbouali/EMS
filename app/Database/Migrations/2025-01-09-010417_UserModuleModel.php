<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserModuleTable extends Migration
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
            'idUser' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'idModule' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
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
        $this->forge->createTable('usermodule');
        $this->forge->addForeignKey('idUser', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idModule', 'module', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('usermodule');
    }
}
