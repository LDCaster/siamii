<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ButiranMutu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'sub_standar_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'butiran_mutu_isi' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sub_standar_id', 'sub_standar', 'id');
        $this->forge->createTable('butiran_mutu');
    }

    public function down()
    {
        $this->forge->dropTable('butiran_mutu');
    }
}
