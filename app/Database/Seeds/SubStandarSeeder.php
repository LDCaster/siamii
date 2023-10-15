<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubStandarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_sub' => 'Standar Peneliti',  // 1
                'standar_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // [
            //     'nama_sub' => 'Standar Hasil Penelitian.', // 2
            //     'standar_id' => 2,
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
        ];

        foreach ($data as $row) {
            $this->db->table('sub_standar')->insert($row);
        }
    }
}
