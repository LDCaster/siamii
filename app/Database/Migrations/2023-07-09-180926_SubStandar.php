<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubStandar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_sub' => ['type' => 'TEXT'],
            'standar_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            // '' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('standar_id', 'standar', 'id');
        $this->forge->createTable('sub_standar');
    }

    public function down()
    {
        $this->forge->dropTable('sub_standar');
    }
}
