<?php

namespace App\Models;

use CodeIgniter\Model;

class StandarModel extends Model
{
    protected $table = 'standar';
    protected $allowedFields = [
        'nama', 'unit_prodi_id', 'tahun_periode', 'deskripsi', 'created_at', 'updated_at'
    ];

    public function getStandarWithUnit()
    {
        return $this->select('standar.*, unit_prodi.nama as nama_unit_prodi')
            ->join('unit_prodi', 'unit_prodi.id = standar.unit_prodi_id')
            ->orderBy('tahun_periode', 'ASC')
            ->findAll();
    }
}
