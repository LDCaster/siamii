<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EvaluasiDanPelaporanAMI extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'h_ami_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'status_ketercapaian' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true], // Make nullable
            'hasil_evaluasi_diri' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'bukti_evaluasi_diri' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'hasil_audit_dokumen' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'daftar_tilik' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'hasil_temuan_audit' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'status_temuan' => ['type' => 'ENUM("Tercapai", "Tidak")', 'null' => true], // Make nullable
            'hasil_rekomendasi' => ['type' => 'TEXT', 'null' => true], // Make nullable
            // 'bukti_rtm' => ['type' => 'TEXT', 'null' => true], // Make nullable
            // 'bukti_rtl' => ['type' => 'TEXT', 'null' => true], // Make nullable
            // 'deskripsi_pengendalian' => ['type' => 'TEXT', 'null' => true], // Make nullable
            // 'bukti_peningkatan' => ['type' => 'TEXT', 'null' => true], // Make nullable
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('h_ami_id', 'hasil_audit_mutu_internal', 'id');
        $this->forge->createTable('evaluasi_dan_pelaporan_ami');
    }

    public function down()
    {
        $this->forge->dropTable('evaluasi_dan_pelaporan_ami');
    }
}
