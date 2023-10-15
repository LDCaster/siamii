<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Admin User
            [
                'nik_nip' => '123', // 1
                'nama' => 'Saya Admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT), // Hashed password
                'jabatan' => 'Administrator',
                'unit_prodi_id' => 1,
                'role' => 1,
                'image' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Auditee User
            [
                'nik_nip' => '456', // 2
                'nama' => 'Auditee Kemahasiswaan',
                'email' => 'auditee@example.com',
                'password' => password_hash('auditee', PASSWORD_DEFAULT), // Hashed password
                'jabatan' => 'Auditee Position',
                'unit_prodi_id' => 4,
                'role' => 2,
                'image' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nik_nip' => '654', // 3
                'nama' => 'Auditee Umum',
                'email' => 'auditee@example.com',
                'password' => password_hash('auditee', PASSWORD_DEFAULT), // Hashed password
                'jabatan' => 'Auditee Position',
                'unit_prodi_id' => 3,
                'role' => 2,
                'image' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Auditor User
            [
                'nik_nip' => '789', // 4
                'nama' => 'Auditor Kemahasiswaan',
                'email' => 'auditor@example.com',
                'password' => password_hash('auditor', PASSWORD_DEFAULT), // Hashed password
                'jabatan' => 'Auditor Position',
                'unit_prodi_id' => 4,
                'role' => 3,
                'image' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nik_nip' => '987', // 5
                'nama' => 'Auditor Umum',
                'email' => 'auditor@example.com',
                'password' => password_hash('auditor', PASSWORD_DEFAULT), // Hashed password
                'jabatan' => 'Auditor Position',
                'unit_prodi_id' => 3,
                'role' => 3,
                'image' => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $this->db->table('users')->insert($row);
        }
    }
}
