<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitProdiModel extends Model
{
    protected $table = 'unit_prodi';
    protected $allowedFields = [
        'nama', 'created_at', 'updated_at'
    ];
}
