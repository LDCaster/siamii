<?php

namespace App\Models;

use CodeIgniter\Model;

class StandarModel extends Model
{
    protected $table = 'standar';
    protected $allowedFields = [
        'standar', 'unit_prodi_id', 'tahun_periode', 'deskripsi', 'created_at', 'updated_at'
    ];

    public function getStandarWithUnit()
    {
        return $this->select('standar.*, unit_prodi.nama')
            ->join('unit_prodi', 'unit_prodi.id = standar.unit_prodi_id')
            ->findAll();
    }
}
