<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nik_nip' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'jabatan' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'unit_prodi_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'role' => ['type' => 'ENUM("admin", "auditee", "auditor")', 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'default.png', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('unit_prodi_id', 'unit_prodi', 'id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
