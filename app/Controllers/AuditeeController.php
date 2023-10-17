<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EvaluasiPelaporanModel;
use App\Models\HAMIModel;
use App\Models\ProsesAMIModel;

class AuditeeController extends BaseController
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
        // dd($prosesAMI);
        // dd($_SESSION['unit_prodi_id']);
        // Format tanggal dalam loop jika diperlukan
        foreach ($prosesAMI as &$proses) {
            $proses['tgl_mulai'] = date("d-m-Y", strtotime($proses['tgl_mulai']));
            $proses['tgl_selesai'] = date("d-m-Y", strtotime($proses['tgl_selesai']));
        }

        // Periksa session 'role_id' untuk menentukan apakah pengguna adalah admin
        $isAdmin = session()->get('role_id') == 'admin';

        $data = [
            'title' => 'Evaluasi Diri',
            'prosesAMI' => $prosesAMI,
            'isAdmin' => $isAdmin,

        ];
        // return view('pages/dashboard', $data); // Menggunakan view "
        return view('pages/ami/evaluasidiri/evaluasi_diri', $data); // Menggunakan view "
    }

    public function viewEvaluasiDiri($hAmiId)
    {
        // Ambil data evaluasi berdasarkan h_ami_id
        $evaluasi = $this->evaluasiModel->where('h_ami_id', $hAmiId)->first();

        $hasilAMI = $this->hasilAMIModel->getDataforViewEvaluasiDiri($hAmiId);
        // dd($hasilAMI);
        // Jika data evaluasi tidak ditemukan, redirect atau tampilkan pesan error
        if (!$evaluasi) {
            return redirect()->to('/error404'); // Ganti dengan URL halaman error jika diperlukan
        }

        // Data evaluasi ditemukan, tampilkan view dengan data evaluasi
        $data = [
            'title' => 'Form Evaluasi Diri',
            'evaluasi' => $evaluasi,
            'hasilAMI' => $hasilAMI,
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/ami/evaluasidiri/index', $data);
    }

    public function updateEvaluasiDiri($id)
    {
        $evaluasi = $this->evaluasiModel->where('id', $id)->first();

        $validationRules = [
            'status_ketercapaian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Ketercapaian harus diisi!',
                ],
            ],
            'hasil_evaluasi_diri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hasil Eveluasi Diri harus diisi!',
                ],
            ],
            'bukti_evaluasi_diri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bukti Eveluasi Diri harus diisi!',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $status_ketercapaian = $this->request->getVar('status_ketercapaian');
        $hasil_evaluasi_diri = $this->request->getVar('hasil_evaluasi_diri');
        $bukti_evaluasi_diri = $this->request->getVar('bukti_evaluasi_diri');

        $data = $this->evaluasiModel->update($id, [
            'status_ketercapaian' => $status_ketercapaian,
            'hasil_evaluasi_diri' => $hasil_evaluasi_diri,
            'bukti_evaluasi_diri' => $bukti_evaluasi_diri,
        ]);

        session()->setFlashdata('pesan', 'Evaluasi Diri berhasil diupdate!');
        return redirect()->to('/hasil-ami/evaluasi-diri/' . $evaluasi['h_ami_id']);
    }

    public function detail($id)
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

        return view('pages/ami/detail', $data);
    }
}
