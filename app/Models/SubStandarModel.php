<?php

namespace App\Models;

use CodeIgniter\Model;

class SubStandarModel extends Model
{

    protected $table = 'sub_standar';
    protected $allowedFields = [
        'nama_sub', 'standar_id', 'created_at', 'updated_at'
    ];

    public function getDataByStandarId($standarId)
    {
        return $this->where('standar_id', $standarId)->findAll();
    }
}
