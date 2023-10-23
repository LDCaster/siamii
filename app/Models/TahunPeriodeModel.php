<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunPeriodeModel extends Model
{
    protected $table = 'tahun_periode';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'tahun', 'periode', 'created_at', 'updated_at'
    ];

    public function getDataByYear()
    {
        return $this->orderBy('tahun', 'asc')
            ->orderBy('periode', 'asc')
            ->findAll();
    }
}
