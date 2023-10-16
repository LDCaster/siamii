<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ButiranModel;
use App\Models\EvaluasiPelaporanModel;
use App\Models\HAMIModel;
use App\Models\ProsesAMIModel;
use App\Models\SubStandarModel;

class HasilAMIController extends BaseController
{
    protected $hasilamiModel;
    protected $prosesAMIModel;
    protected $butiranmutuModel;
    protected $evaluasiModel;
    protected $substandarModel;

    public function __construct()
    {
        $this->hasilamiModel = new HAMIModel();
        $this->prosesAMIModel = new ProsesAMIModel();
        $this->butiranmutuModel = new ButiranModel();
        $this->evaluasiModel = new EvaluasiPelaporanModel();
        $this->substandarModel = new SubStandarModel();
    }

    public function index($id)
    {
        $prosesAMI = $this->prosesAMIModel->find($id);
        $hasilAMI = $this->hasilamiModel->getDataByProsesAmiId($id);
        // dd($hasilAMI);
        $data = [
            'title' => 'Hasil Audit Mutu Internal',
            'hasilAMI' => $hasilAMI,
            'prosesAMI' => $prosesAMI,
        ];
        return view('pages/ami/hasilami/index', $data); // Menggunakan view "
    }

    public function create($id)
    {
        // Ambil data prosesAMI berdasarkan ID
        $prosesAMI = $this->prosesAMIModel->getSubStandarByStandarId($id);
        // dd($prosesAMI);

        // Ambil butiran_mutu sesuai dengan standar_id dari data prosesAMI
        $butiran_mutu = $this->butiranmutuModel->findAll();

        $data = [
            'title' => 'Tambah Siklus',
            'prosesAMI' => $prosesAMI,
            'butiran_mutu' => $butiran_mutu,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/ami/hasilami/create', $data);
    }


    public function getButiranMutu($subStandarId)
    {
        // Gantilah "ModelAnda" dengan nama model yang sesuai
        $butiranMutu = $this->butiranmutuModel->getButiranMutuByProses($subStandarId);
        // dd($butiranMutu);

        // Kembalikan data dalam format JSON
        return $this->response->setJSON($butiranMutu);
    }

    public function save()
    {
        $validationRules = [
            'proses_ami_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Siklus dan Standar harus diisi!',
                ],
            ],
            'sub_standar_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sub Standar harus diisi!',
                ],
            ],
            'butir_mutu_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Butiran Mutu harus diisi!',
                ],
            ],
            'indikator_target' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Indikator target harus diisi!',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $proses_ami_id = $this->request->getVar('proses_ami_id');
        $sub_standar = $this->request->getVar('sub_standar_id'); // Mengambil nilai bukan ID
        $butiran_mutu_isi = $this->request->getVar('butir_mutu_isi'); // Mengambil nilai bukan ID
        $indikator_target = $this->request->getVar('indikator_target');

        $existingData = $this->hasilamiModel->where([
            'sub_standar' => $sub_standar,
            'butiran_mutu_isi' => $butiran_mutu_isi,
        ])->first();

        if ($existingData) {
            // Data with the same 'proses_ami_id' and 'butiran_mutu_isi' already exists, so prevent adding new data
            session()->setFlashdata('pesan', 'Data Hasil AMI ini sudah ada!');
            return redirect()->to('/hasil-ami/create');
        }

        // Continue with saving the new data
        $this->hasilamiModel->save([
            'proses_ami_id' => $proses_ami_id,
            'sub_standar' => $sub_standar,
            'butiran_mutu_isi' => $butiran_mutu_isi,
            'indikator_target' => $indikator_target,
        ]);

        // Get the ID of the newly inserted record in hasilamiModel
        $newlyInsertedId = $this->hasilamiModel->insertID();

        // Create data in the evaluasiModel with h_ami_id from hasilamiModel
        $this->evaluasiModel->save([
            'h_ami_id' => $newlyInsertedId, // Menggunakan ID yang baru saja dimasukkan ke hasilamiModel
            'status_ketercapaian' => null,
            'hasil_evaluasi_diri' => null,
            'bukti_evaluasi_diri' => null,
            'hasil_audit_dokumen' => null,
            'daftar_tilik' => null,
            'hasil_temuan_audit' => null,
            'status_temuan' => null,
            'hasil_rekomendasi' => null,
        ]);


        session()->setFlashdata('pesan', 'Data Hasil AMI Berhasil ditambahkan!');
        return redirect()->to('/proses-ami/hasil-ami/' . $proses_ami_id);
    }

    public function delete($id)
    {
        // Find the Hasil AMI record by ID
        $hasilAMI = $this->hasilamiModel->find($id);

        // Check if the record exists
        if (!$hasilAMI) {
            return redirect()->to('/proses-ami/hasil-ami/' . $hasilAMI['proses_ami_id'])->with('error', 'Data Hasil AMI tidak ditemukan!');
        }

        // Delete related records in Evaluasi AMI
        $this->evaluasiModel->where('h_ami_id', $id)->delete();

        // Delete the Hasil AMI record
        $this->hasilamiModel->delete($id);

        // Set a flash message to indicate successful deletion
        session()->setFlashdata('pesan', 'Data Hasil AMI dan relasinya berhasil dihapus!');

        // Redirect back to the Hasil AMI index page
        return redirect()->to('/proses-ami/hasil-ami/' . $hasilAMI['proses_ami_id']);
    }


    public function detail($id)
    {
        $hasilAMI = $this->hasilamiModel->getDataByProsesAmiId($id);
        // dd($hasilAMI);

        if (!$hasilAMI) {
            return redirect()->to('/dashboard')->with('error', 'Data Hasil Audit Mutu Internal belum ditemukan!');
        }

        $data = [
            'title' => 'Detail Hasil AMI',
            'hasilAMI' => $hasilAMI,
        ];

        return view('ami/detail', $data);
    }
}
