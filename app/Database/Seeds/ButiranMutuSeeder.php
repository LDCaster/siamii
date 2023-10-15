<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ButiranMutuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Entries for sub_standar_id 1
            [
                'sub_standar_id' => 1,
                'butiran_mutu_isi' => '1. Tim Peneliti terdiri atas Peneliti Utama dan Anggota',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'sub_standar_id' => 1,
                'butiran_mutu_isi' => '2. Peneliti utama sekurang-kurangnya bergelar S2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Entries for sub_standar_id 2      
            // [
            //     'sub_standar_id' => 2,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 1 terkait aktivitas penelitian',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'sub_standar_id' => 2,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 2 terkait aktivitas penelitian',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // Entries for sub_standar_id 3
            // [
            //     'sub_standar_id' => 3,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 1 terkait pengabdian kepada masyarakat',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'sub_standar_id' => 3,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 2 terkait pengabdian kepada masyarakat',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'sub_standar_id' => 3,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 3 terkait pengabdian kepada masyarakat',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // // Entries for sub_standar_id 4
            // [
            //     'sub_standar_id' => 4,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 1 terkait ketercapaian visi dan misi',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'sub_standar_id' => 4,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 2 terkait ketercapaian visi dan misi',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // // Entries for sub_standar_id 5
            // [
            //     'sub_standar_id' => 5,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 1 terkait pelayanan terhadap mahasiswa',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'sub_standar_id' => 5,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 2 terkait pelayanan terhadap mahasiswa',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // // Entries for sub_standar_id 6
            // [
            //     'sub_standar_id' => 6,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 1 terkait kerja sama dengan pihak eksternal',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'sub_standar_id' => 6,
            //     'butiran_mutu_isi' => 'Butiran mutu/isi 2 terkait kerja sama dengan pihak eksternal',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
        ];

        foreach ($data as $row) {
            $this->db->table('butiran_mutu')->insert($row);
        }
    }
}
