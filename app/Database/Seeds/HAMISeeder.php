<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HAMISeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'proses_ami_id' => 1,
                'butiran_mutu_isi' => '1. Tim Peneliti terdiri atas Peneliti Utama dan Anggota',
                'Indikator_Target' => '1 ketua dan anggota dalam satu tim ',
            ],
            [
                'proses_ami_id' => 1,
                'butiran_mutu_isi' => '2. Peneliti utama sekurang-kurangnya bergelar S2',
                'Indikator_Target' => 'pendidikan S2 ',
            ],
            // Add more dummy data as needed
        ];

        // Using DB query builder to insert data
        $this->db->table('hasil_audit_mutu_internal')->insertBatch($data);
    }
}
