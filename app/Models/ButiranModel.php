<?php

namespace App\Models;

use CodeIgniter\Model;

class ButiranModel extends Model
{
    protected $table = 'butiran_mutu';
    protected $allowedFields = [
        'sub_standar_id', 'butiran_mutu_isi', 'created_at', 'updated_at'
    ];

    public function getButiranWithStandar()
    {
        return $this->select('butiran_mutu.*, sub_standar.nama_sub, standar.nama, standar.tahun_periode')
            ->join('sub_standar', 'sub_standar.id = butiran_mutu.sub_standar_id')
            ->join('standar', 'standar.id = sub_standar.standar_id')
            ->findAll();
    }

    public function getButiranWithStandarFind($id)
    {
        return $this->select('butiran_mutu.*, sub_standar.nama_sub, standar.nama, standar.tahun_periode, sub_standar.standar_id')
            ->join('sub_standar', 'sub_standar.id = butiran_mutu.sub_standar_id')
            ->join('standar', 'standar.id = sub_standar.standar_id')
            ->where('butiran_mutu.id', $id)
            ->find();
    }


    public function getButiranMutuByProses($prosesId)
    {
        return $this->where('sub_standar_id', $prosesId)->findAll();
    }
}
