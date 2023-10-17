<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EvaluasiPelaporanModel;
use App\Models\HAMIModel;
use App\Models\ProsesAMIModel;
use CodeIgniter\Validation\Rules;

class PengendalianController extends BaseController
{
    protected $prosesAMIModel;
    protected $evaluasiModel;
    protected $hasilAMIModel;

    public function __construct()
    {
        $this->prosesAMIModel = new ProsesAMIModel();
        $this->evaluasiModel = new EvaluasiPelaporanModel();
        $this->hasilAMIModel = new HAMIModel();
    }

    public function index()
    {
        $prosesAMI = $this->prosesAMIModel->getProsesAMIWithDetails();
        // dd($prosesAMI);

        // Periksa session 'role_id' untuk menentukan apakah pengguna adalah admin
        $isAdmin = session()->get('role_id') == 'admin';

        $data = [
            'title' => 'Pengendalian',
            'prosesAMI' => $prosesAMI,
            'isAdmin' => $isAdmin,

        ];
        // return view('pages/dashboard', $data); // Menggunakan view "
        return view('pages/ami/pengendalian/index', $data); // Menggunakan view "
    }

    public function viewPengendalian($id)
    {
        // Ambil data prosesAMI
        $prosesAMI = $this->prosesAMIModel->getProsesAMIWithDetails();
        // dd($prosesAMI);
        $hasilAMI = $this->hasilAMIModel->getDataByProsesAmiId($id);
        // dd($hasilAMI);

        // Jika data prosesAMI tidak ditemukan, redirect atau tampilkan pesan error
        if (!$prosesAMI) {
            return redirect()->to('/error404'); // Ganti dengan URL halaman error jika diperlukan
        }

        // Data prosesAMI ditemukan, tampilkan view dengan data prosesAMI
        $data = [
            'title' => 'Form Pengendalian',
            'prosesAMI' => $prosesAMI,
            'hasilAMI' => $hasilAMI,
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/ami/pengendalian/form_pengendalian', $data);
    }


    public function updatePengendalian($id)
    {
        $prosesAMI = $this->prosesAMIModel->where('id', $id)->first();

        $validationRules = [
            'bukti_rtm' => [
                'rules' => 'valid_url_strict',
                'errors' => [
                    'valid_url_strict' => 'Bukti RTM berupa link.',
                ]
            ],
            'bukti_rtl' => [
                'rules' => 'valid_url_strict',
                'errors' => [
                    'valid_url_strict' => 'Bukti RTL berupa link.',
                ]
            ],
        ];

        // Validasi input data
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bukti_rtm = $this->request->getVar('bukti_rtm');
        $bukti_rtl = $this->request->getVar('bukti_rtl');
        $deskripsi_pengendalian = $this->request->getVar('deskripsi_pengendalian');
        // dd($bukti_rtl);
        // Cek jika data kosong dan setel ke NULL jika iya
        $dataToUpdate = [
            'bukti_rtm' => $bukti_rtm ?: null,
            'bukti_rtl' => $bukti_rtl ?: null,
            'deskripsi_pengendalian' => $deskripsi_pengendalian ?: null,
        ];

        $this->prosesAMIModel->update($id, $dataToUpdate);

        session()->setFlashdata('pesan', 'Data Pengendalian berhasil diupdate!');
        return redirect()->to('/hasil-ami/pengendalian/' . $prosesAMI['id']);
    }
}
