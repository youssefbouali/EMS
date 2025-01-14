<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNoteTable extends Migration
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
            #'session' => [
            #    'type'       => 'VARCHAR',
            #    'constraint' => 100,
            #],
            /*'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],*/
            'idModule' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'idUserProfessor' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'idUserStudent' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'noteNormal' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'noteRattrapage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'valide' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'archive' => [
                'type'       => 'INT',
                'constraint' => 2,
                'null'       => true,
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
        $this->forge->createTable('note');
        $this->forge->addForeignKey('IdUserProfessor', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('IdUserStudent', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('note');
    }
}
