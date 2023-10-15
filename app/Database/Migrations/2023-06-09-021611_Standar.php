<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Standar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 50],
            'unit_prodi_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'tahun_periode' => ['type' => 'VARCHAR', 'constraint' => 20],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('unit_prodi_id', 'unit_prodi', 'id');
        $this->forge->createTable('standar');
    }

    public function down()
    {
        $this->forge->dropTable('standar');
    }
}
