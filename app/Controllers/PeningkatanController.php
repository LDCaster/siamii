<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EvaluasiPelaporanModel;
use App\Models\HAMIModel;
use App\Models\ProsesAMIModel;

class PeningkatanController extends BaseController
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
            'title' => 'Peningkatan',
            'prosesAMI' => $prosesAMI,
            'isAdmin' => $isAdmin,

        ];
        // return view('pages/dashboard', $data); // Menggunakan view "
        return view('pages/ami/peningkatan/index', $data); // Menggunakan view "
    }

    public function viewPeningkatan($id)
    {
        // Ambil data prosesAMI
        $prosesAMI = $this->prosesAMIModel->getProsesAMIWithDetails();

        $hasilAMI = $this->hasilAMIModel->getDataByProsesAmiId($id);
        // dd($hasilAMI);

        // Jika data evaluasi tidak ditemukan, redirect atau tampilkan pesan error
        if (!$prosesAMI) {
            return redirect()->to('/error404'); // Ganti dengan URL halaman error jika diperlukan
        }

        // Data evaluasi ditemukan, tampilkan view dengan data evaluasi
        $data = [
            'title' => 'Form Peningkatan',
            'prosesAMI' => $prosesAMI,
            'hasilAMI' => $hasilAMI,
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/ami/peningkatan/form_peningkatan', $data);
    }


    public function updatePeningkatan($id)
    {
        $prosesAMI = $this->prosesAMIModel->where('id', $id)->first();

        $validationRules = [
            'bukti_peningkatan' => [
                'rules' => 'valid_url_strict',
                'errors' => [
                    'valid_url_strict' => 'Bukti Peningkatan berupa link.',
                ]
            ],
        ];

        // Validasi input data
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bukti_peningkatan = $this->request->getVar('bukti_peningkatan');

        // Cek jika data kosong dan setel ke NULL jika iya
        $dataToUpdate = [
            'bukti_peningkatan' => $bukti_peningkatan ?: null,
        ];

        $this->prosesAMIModel->update($id, $dataToUpdate);

        session()->setFlashdata('pesan', 'Data Peningkatan berhasil diupdate!');
        return redirect()->to('/hasil-ami/peningkatan/' . $prosesAMI['id']);
    }
}
