<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TahunPeriodeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun' => 2023,
                'periode' => 'Ganjil',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tahun' => 2023,
                'periode' => 'Genap',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tahun' => 2024,
                'periode' => 'Tahunan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tahun' => 2024,
                'periode' => 'Ganjil',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $this->db->table('tahun_periode')->insert($row);
        }
    }
}
