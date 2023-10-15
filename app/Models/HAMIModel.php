<?php

namespace App\Models;

use CodeIgniter\Model;

class HAMIModel extends Model
{
    protected $table = 'hasil_audit_mutu_internal';
    protected $allowedFields = [
        'proses_ami_id', 'butiran_mutu_isi', 'indikator_target', 'created_at', 'updated_at'
    ];

    public function ByHAMIid($prosesAmiId)
    {
        return $this->select('hasil_audit_mutu_internal.*, evaluasi_dan_pelaporan_ami.status_ketercapaian, evaluasi_dan_pelaporan_ami.hasil_evaluasi_diri, evaluasi_dan_pelaporan_ami.bukti_evaluasi_diri, evaluasi_dan_pelaporan_ami.hasil_audit_dokumen, evaluasi_dan_pelaporan_ami.daftar_tilik, evaluasi_dan_pelaporan_ami.hasil_temuan_audit, evaluasi_dan_pelaporan_ami.status_temuan, evaluasi_dan_pelaporan_ami.hasil_rekomendasi, evaluasi_dan_pelaporan_ami.bukti_rtm, evaluasi_dan_pelaporan_ami.bukti_rtl, evaluasi_dan_pelaporan_ami.bukti_peningkatan')
            ->join('evaluasi_dan_pelaporan_ami', 'evaluasi_dan_pelaporan_ami.h_ami_id = hasil_audit_mutu_internal.id', 'left') // Assuming it's a left join
            ->where('hasil_audit_mutu_internal.id', $prosesAmiId)
            ->first(); // Retrieve only the first matching record
    }

    public function getDataByProsesAmiId($prosesAmiId)
    {
        return $this->select('hasil_audit_mutu_internal.*, evaluasi_dan_pelaporan_ami.status_ketercapaian, evaluasi_dan_pelaporan_ami.hasil_evaluasi_diri, evaluasi_dan_pelaporan_ami.bukti_evaluasi_diri, evaluasi_dan_pelaporan_ami.hasil_audit_dokumen, evaluasi_dan_pelaporan_ami.daftar_tilik, evaluasi_dan_pelaporan_ami.hasil_temuan_audit, evaluasi_dan_pelaporan_ami.status_temuan, evaluasi_dan_pelaporan_ami.hasil_rekomendasi, evaluasi_dan_pelaporan_ami.bukti_rtm, evaluasi_dan_pelaporan_ami.bukti_rtl, evaluasi_dan_pelaporan_ami.deskripsi_pengendalian, evaluasi_dan_pelaporan_ami.bukti_peningkatan')
            ->join('evaluasi_dan_pelaporan_ami', 'evaluasi_dan_pelaporan_ami.h_ami_id = hasil_audit_mutu_internal.id', 'left') // Assuming it's a left join
            ->where('hasil_audit_mutu_internal.proses_ami_id', $prosesAmiId)
            ->findAll();
    }

    public function exportExcelProsesAMI($prosesAmiId)
    {
        return $this->select('hasil_audit_mutu_internal.*, evaluasi_dan_pelaporan_ami.status_ketercapaian, evaluasi_dan_pelaporan_ami.hasil_evaluasi_diri, evaluasi_dan_pelaporan_ami.bukti_evaluasi_diri, evaluasi_dan_pelaporan_ami.hasil_audit_dokumen, evaluasi_dan_pelaporan_ami.daftar_tilik, evaluasi_dan_pelaporan_ami.hasil_temuan_audit, evaluasi_dan_pelaporan_ami.status_temuan, evaluasi_dan_pelaporan_ami.hasil_rekomendasi, evaluasi_dan_pelaporan_ami.bukti_rtm, evaluasi_dan_pelaporan_ami.bukti_rtl, evaluasi_dan_pelaporan_ami.deskripsi_pengendalian, evaluasi_dan_pelaporan_ami.bukti_peningkatan, proses_ami.tahun_periode_akademik_id,  standar.standar as nama_standar, users.nama as auditor, proses_ami.tgl_mulai, proses_ami.tgl_selesai')
            ->join('evaluasi_dan_pelaporan_ami', 'evaluasi_dan_pelaporan_ami.h_ami_id = hasil_audit_mutu_internal.id', 'left')
            ->join('proses_ami', 'proses_ami.id = hasil_audit_mutu_internal.proses_ami_id', 'left')
            ->join('tahun_periode', 'tahun_periode.id = proses_ami.tahun_periode_akademik_id', 'left')
            ->join('standar', 'standar.id = proses_ami.standar_id', 'left')
            ->join('users', 'users.id = proses_ami.auditor_id', 'left')
            ->where('hasil_audit_mutu_internal.proses_ami_id', $prosesAmiId)
            ->findAll();
    }

    public function getHAMIDetails()
    {
        return $this->select('hasil_audit_mutu_internal.*, proses_ami.tahun_periode_akademik_id, proses_ami.standar_id, proses_ami.auditor_id, tahun_periode.tahun, tahun_periode.periode, standar.standar, users.nama as nama_auditor')
            ->join('proses_ami', 'proses_ami.id = hasil_audit_mutu_internal.proses_ami_id')
            ->join('tahun_periode', 'tahun_periode.id = proses_ami.tahun_periode_akademik_id')
            ->join('standar', 'standar.id = proses_ami.standar_id')
            ->join('users', 'users.id = proses_ami.auditor_id')
            ->orderBy('standar.standar', 'ASC')
            ->find();
    }
}
