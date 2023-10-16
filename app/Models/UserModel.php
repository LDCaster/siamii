<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = [
        'nik_nip', 'nama', 'email', 'password', 'jabatan', 'unit_prodi_id', 'role', 'image', 'created_at', 'updated_at'
    ];

    public function getDataByUserId($userId)
    {
        return $this->select('users.*, unir_prodi.nama AS nama')
            ->join('unit_prodi', 'unit_prodi.id = users.unit_prodi_id', 'left')
            ->where('users.id', $userId)
            ->first();
    }


    public function getUserDetails()
    {
        return $this->select('users.*, unit_prodi.nama as nama_unit_prodi')
            ->join('unit_prodi', 'unit_prodi.id = users.unit_prodi_id')
            ->findAll();
    }
    public function getUserByNikNip($nikNip)
    {
        return $this->select('users.*, unit_prodi.nama as nama_unit_prodi')
            ->join('unit_prodi', 'unit_prodi.id = users.unit_prodi_id')
            ->where('nik_nip', $nikNip)
            ->first();
    }
    public function getAuditors()
    {
        return $this->select('users.*, unit_prodi.nama as nama_unit_prodi')
            ->join('unit_prodi', 'unit_prodi.id = users.unit_prodi_id')
            ->where('users.role', 3) // Ubah sesuai dengan id peran "auditor" yang sesuai dalam database
            ->findAll();
    }
}
