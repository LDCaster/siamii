<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProsesAMISeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun_periode_id' => 1, // 1
                'standar_id' => 2, // Standar Mahasiswa
                'auditor_id' => 4,
                'bukti_rtm' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                'bukti_rtl' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
                'deskripsi_pengendalian' => 'tes',
                'bukti_peningkatan' => 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=siami1&table=evaluasi_dan_pelaporan_ami',
            ],
            // [
            //     'tahun_periode_id' => 1, //2
            //     'standar_id' => 4, // Standar Visi Misi
            //     'auditor_id' => 4,
            // ],
            // Add more data as needed
        ];

        // Using DB query builder to insert data
        $this->db->table('proses_ami')->insertBatch($data);
    }
}
