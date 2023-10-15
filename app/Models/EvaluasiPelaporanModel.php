<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluasiPelaporanModel extends Model
{
    protected $table = 'evaluasi_dan_pelaporan_ami';
    protected $allowedFields = [
        'h_ami_id', 'status_ketercapaian', 'hasil_evaluasi_diri', 'bukti_evaluasi_diri', 'hasil_audit_dokumen', 'daftar_tilik', 'hasil_temuan_audit', 'status_temuan', 'hasil_rekomendasi', 'created_at', 'updated_at'
    ];

    public function getEvaluasiByHAmiId($hAmiId)
    {
        // Ambil data evaluasi berdasarkan h_ami_id
        $evaluasi = $this->where('h_ami_id', $hAmiId)->first();
    }
}
