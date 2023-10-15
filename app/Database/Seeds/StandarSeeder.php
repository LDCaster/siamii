<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StandarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Pendidikan',  // 1
                'unit_prodi_id' => 2,
                'deskripsi' => 'Standar terkait kualitas pendidikan di unit/prodi',
                'tahun_periode' => '2023',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Penelitian', // 2
                'unit_prodi_id' => 1,
                'deskripsi' => 'Standar terkait aktivitas penelitian',
                'tahun_periode' => '2023',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'P3M', // 3
                'unit_prodi_id' => 1,
                'deskripsi' => 'Standar terkait Pusat Penelitian dan Pengabdian pada Masyarakat ',
                'tahun_periode' => '2024',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Visi Misi', // 4
                'unit_prodi_id' => 3,
                'deskripsi' => 'Standar terkait ketercapaian visi dan misi',
                'tahun_periode' => '2024',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Mahasiswa', // 5
                'unit_prodi_id' => 4,
                'deskripsi' => 'Standar terkait pelayanan terhadap mahasiswa',
                'tahun_periode' => '2025',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Kerja Sama', // 6 
                'unit_prodi_id' => 2,
                'deskripsi' => 'Standar terkait kerja sama dengan pihak eksternal',
                'tahun_periode' => '2025',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $this->db->table('standar')->insert($row);
        }
    }
}
