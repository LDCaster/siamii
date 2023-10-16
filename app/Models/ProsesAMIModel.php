<?php

namespace App\Models;

use CodeIgniter\Model;

class ProsesAMIModel extends Model
{
    protected $table = 'proses_ami';
    protected $allowedFields = [
        'tahun_periode_id', 'standar_id', 'auditor_id', 'tgl_mulai', 'tgl_selesai', 'status', 'bukti_rtm', 'bukti_rtl', 'deskripsi_pengendalian', 'bukti_peningkatan', 'created_at', 'updated_at'
    ];

    public function getProsesAMIByAuditee($unitProdiId)
    {
        return $this->join('standar', 'standar.id = proses_ami.standar_id')
            ->join('unit_prodi', 'unit_prodi.id = standar.unit_prodi_id')
            ->where('unit_prodi.nama', $unitProdiId)
            ->countAllResults();
    }

    public function getProsesAMIByUserid($auditorId)
    {
        return $this->where('auditor_id', $auditorId)->countAllResults();
    }


    public function getProsesAMI()
    {
        return $this->select('proses_ami.*, tahun_periode.tahun, tahun_periode.periode, standar.nama, users.nama as nama_auditor')
            ->join('tahun_periode', 'tahun_periode.id = proses_ami.tahun_periode_id')
            ->join('standar', 'standar.id = proses_ami.standar_id')
            ->join('users', 'users.id = proses_ami.auditor_id')
            ->findAll();
    }

    public function getProsesAMIWithDetails()
    {
        // $user_id = $_SESSION['user_id'];
        // $role_id = $_SESSION['role_id'];
        $user_id = session('user_id');
        $role_id = session('role_id');

        $query = $this->select('proses_ami.*, tahun_periode.tahun, tahun_periode.periode, standar.standar, users.nama as nama_auditor, standar.unit_prodi_id, unit_prodi.nama_unit_prodi')
            ->join('tahun_periode', 'tahun_periode.id = proses_ami.tahun_periode_id')
            ->join('standar', 'standar.id = proses_ami.standar_id')
            ->join('users', 'users.id = proses_ami.auditor_id')
            ->join('unit_prodi', 'unit_prodi.id = standar.unit_prodi_id'); // Join unit_prodi

        if ($role_id == 'auditor') {
            // If the user is an auditor, retrieve data based on auditor_id
            $query->where('proses_ami.auditor_id', $user_id);
        } elseif ($role_id == 'auditee') {
            // If the user is an auditee, retrieve data based on nama_unit_prodi
            $nama_unit_prodi = $_SESSION['unit_prodi_id'];
            $query->where('unit_prodi.nama_unit_prodi', $nama_unit_prodi);
        } elseif ($role_id == 'admin') {
            // If the user is an admin, no specific filtering is needed, so no need to add any conditions.
        } else {
            // Handle other roles or provide a default behavior
            return []; // You can customize this based on your needs
        }

        return $query->findAll();
    }

    public function getProsesAMIByTahunPeriodeAkademikId($tahun_periode_akademik_id)
    {
        return $this->select('proses_ami.*, tahun_periode.tahun, tahun_periode.periode, standar.standar, users.nama as nama_auditor')
            ->join('tahun_periode', 'tahun_periode.id = proses_ami.tahun_periode_id')
            ->join('standar', 'standar.id = proses_ami.standar_id')
            ->join('users', 'users.id = proses_ami.auditor_id')
            ->where('proses_ami.id', $tahun_periode_akademik_id)
            ->find();
    }
}
