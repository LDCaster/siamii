<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EvaluasidanPelaporanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'h_ami_id' => 1,
                'status_ketercapaian' => 'Tercapai',
                'hasil_evaluasi_diri' => 'Dummy data for Hasil Evaluasi Audit 1',
                'bukti_evaluasi_diri' => 'Dummy data for Bukti Evaluasi Audit 1',
                // Masukkan nilai null untuk kolom yang boleh kosong
                'hasil_audit_dokumen' => null,
                'daftar_tilik' => null,
                'hasil_temuan_audit' => null,
                'status_temuan' => null,
                'hasil_rekomendasi' => null,
                // 'bukti_rtm' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                // 'bukti_rtl' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                // 'deskripsi_pengendalian' => 'tes',
                // 'bukti_peningkatan' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'h_ami_id' => 2,
                'status_ketercapaian' => 'Tidak',
                'hasil_evaluasi_diri' => 'Dummy data for Hasil Evaluasi Audit 2',
                'bukti_evaluasi_diri' => 'Dummy data for Bukti Evaluasi Audit 2',
                // Masukkan nilai null untuk kolom yang boleh kosong
                'hasil_audit_dokumen' => null,
                'daftar_tilik' => null,
                'hasil_temuan_audit' => null,
                'status_temuan' => null,
                'hasil_rekomendasi' => null,
                // 'bukti_rtm' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                // 'bukti_rtl' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                // 'deskripsi_pengendalian' => 'tes',
                // 'bukti_peningkatan' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Tambahkan data dummy lebih banyak sesuai kebutuhan
        ];


        // Using DB query builder to insert data
        $this->db->table('evaluasi_dan_pelaporan_ami')->insertBatch($data);
    }
}
