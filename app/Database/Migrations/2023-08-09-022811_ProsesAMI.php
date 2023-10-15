<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProsesAMI extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'tahun_periode_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'standar_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'auditor_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true], // Add Auditor ID field
            'tgl_mulai' => ['type' => 'DATE', 'null' => true], // Tambahkan field tgl_mulai
            'tgl_selesai' => ['type' => 'DATE', 'null' => true], // Tambahkan field tgl_selesai
            'status' => ["type" => "ENUM('0', '1')", 'default' => '0'],
            'bukti_rtm' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'bukti_rtl' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'deskripsi_pengendalian' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'bukti_peningkatan' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tahun_periode_id', 'tahun_periode', 'id');
        $this->forge->addForeignKey('standar_id', 'standar', 'id');
        $this->forge->addForeignKey('auditor_id', 'users', 'id'); // Add a foreign key constraint to the users table
        $this->forge->createTable('proses_ami');
    }

    public function down()
    {
        $this->forge->dropTable('proses_ami');
    }
}
