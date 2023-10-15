<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HasilAuditMutuInternal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'proses_ami_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'butiran_mutu_isi' => ['type' => 'TEXT'],
            'indikator_target' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proses_ami_id', 'proses_ami', 'id');
        $this->forge->createTable('hasil_audit_mutu_internal');
    }

    public function down()
    {
        $this->forge->dropTable('hasil_audit_mutu_internal');
    }
}
