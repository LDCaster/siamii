<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EvaluasiPelaporanModel;
use App\Models\HAMIModel;
use App\Models\ProsesAMIModel;

class AuditorController extends BaseController
{
    protected $evaluasiModel;
    protected $hasilAMIModel;
    protected $prosesAMIModel;

    public function __construct()
    {
        $this->evaluasiModel = new EvaluasiPelaporanModel();
        $this->hasilAMIModel = new HAMIModel();
        $this->prosesAMIModel = new ProsesAMIModel();
    }

    public function index()
    {
        $prosesAMI = $this->prosesAMIModel->getProsesAMIWithDetails();
        // dd($_SESSION['unit_prodi_id']);

        // Periksa session 'role_id' untuk menentukan apakah pengguna adalah admin
        $isAdmin = session()->get('role_id') == 'admin';

        $data = [
            'title' => 'Evaluasi Audit',
            'prosesAMI' => $prosesAMI,
            'isAdmin' => $isAdmin,

        ];
        // return view('pages/dashboard', $data); // Menggunakan view "
        return view('pages/ami/audit/evaluasi_audit', $data); // Menggunakan view "
    }

    public function viewAudit($id)
    {
        // Ambil data evaluasi berdasarkan h_ami_id
        $evaluasi = $this->evaluasiModel->where('h_ami_id', $id)->first();

        $hasilAMI = $this->hasilAMIModel->ByHAMIid($id);
        // dd($hasilAMI);

        // Jika data evaluasi tidak ditemukan, redirect atau tampilkan pesan error
        if (!$evaluasi) {
            return redirect()->to('/error404'); // Ganti dengan URL halaman error jika diperlukan
        }

        // Data evaluasi ditemukan, tampilkan view dengan data evaluasi
        $data = [
            'title' => 'Form Audit',
            'evaluasi' => $evaluasi,
            'hasilAMI' => $hasilAMI,
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/ami/audit/index', $data);
    }

    public function updateAudit($id)
    {
        $evaluasi = $this->evaluasiModel->where('id', $id)->first();

        $hasil_audit_dokumen = $this->request->getVar('hasil_audit_dokumen');
        $daftar_tilik = $this->request->getVar('daftar_tilik');
        $hasil_temuan_audit = $this->request->getVar('hasil_temuan_audit');
        $status_temuan = $this->request->getVar('status_temuan');
        $hasil_rekomendasi = $this->request->getVar('hasil_rekomendasi');
        // dd($status_temuan);
        // Cek jika data kosong dan setel ke NULL jika iya
        $dataToUpdate = [
            'hasil_audit_dokumen' => $hasil_audit_dokumen ?: null,
            'daftar_tilik' => $daftar_tilik ?: null,
            'hasil_temuan_audit' => $hasil_temuan_audit ?: null,
            'status_temuan' => $status_temuan ?: null,
            'hasil_rekomendasi' => $hasil_rekomendasi ?: null,
        ];

        $this->evaluasiModel->update($id, $dataToUpdate);

        session()->setFlashdata('pesan', 'Audit berhasil diupdate!');
        return redirect()->to('/hasil-ami/audit/' . $evaluasi['h_ami_id']);
    }

    public function detailAudit($id)
    {
        $hasilAMI = $this->hasilAMIModel->getDataByProsesAmiId($id);

        // dd($hasilAMI);

        if (!$hasilAMI) {
            return redirect()->to('/dashboard')->with('error', 'Data Hasil Audit Mutu Internal belum ditemukan!');
        }

        $data = [
            'title' => 'Detail Hasil AMI',
            'hasilAMI' => $hasilAMI,
        ];

        return view('pages/ami/audit/detail-audit', $data);
    }
}
