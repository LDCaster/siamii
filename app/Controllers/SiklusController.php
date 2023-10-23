<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProsesAMIModel;
use App\Models\TahunPeriodeModel;

class SiklusController extends BaseController
{
    protected $tahunperiodeModel;
    protected $prosesAMIModel;

    public function __construct()
    {
        $this->tahunperiodeModel = new TahunPeriodeModel();
        $this->prosesAMIModel = new ProsesAMIModel();
    }

    public function index()
    {
        $siklus = $this->tahunperiodeModel->getDataByYear();
        $data = [
            'title' => 'Data Periode Akademik',
            'siklus' => $siklus
        ];

        return view('/pages/siklus/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Periode Akademik',
            'validation' => \Config\Services::validation()
        ];
        return view('/pages/siklus/create', $data);
    }

    public function save()
    {
        $validationRules = [
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Akademik Harus Diisi!',
                ],
            ],
            'periode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Periode Akademik Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tahun = $this->request->getVar('tahun');
        $periode = $this->request->getVar('periode');

        // Check if the combination of 'tahun' and 'periode' already exists in the database
        $existingData = $this->tahunperiodeModel->where([
            'tahun' => $tahun,
            'periode' => $periode,
        ])->first();

        if ($existingData) {
            // If the combination already exists, return with an error message
            session()->setFlashdata('pesan', 'Data Siklus dengan Tahun Akademik dan Periode Akademik ini sudah ada!');
            return redirect()->to('/siklus/create');
        }

        $this->tahunperiodeModel->save([
            'tahun' => $tahun,
            'periode' => $periode,
        ]);

        session()->setFlashdata('pesan', 'Data Siklus Berhasil ditambahkan!');
        return redirect()->to('/siklus');
    }

    public function edit($id)
    {
        $siklus = $this->tahunperiodeModel->find($id);

        if (!$siklus) {
            return redirect()->to('/siklus')->with('errors', 'Data Siklus Tidak Ditemukan!');
        }
        $data = [
            'title' => 'Edit Periode AKademik',
            'siklus' => $siklus,
            'validation' => \Config\Services::validation()
        ];

        return view('/pages/siklus/edit', $data);
    }

    public function update($id)
    {
        $siklus = $this->tahunperiodeModel->find($id);

        if (!$siklus) {
            return redirect()->to('/siklus')->with('errors', 'Data Siklus Tidak Ditemukan!');
        }

        $validationRules = [
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Akademik Harus Diisi!',
                ],
            ],
            'periode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Periode Akademik Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tahun = $this->request->getVar('tahun');
        $periode = $this->request->getVar('periode');

        // Check if the combination of 'tahun' and 'periode' already exists in the database
        $existingData = $this->tahunperiodeModel->where([
            'tahun' => $tahun,
            'periode' => $periode,
        ])->where('id !=', $id)->first();

        if ($existingData) {
            // If the combination already exists, return with an error message
            session()->setFlashdata('pesan', 'Data Siklus dengan Tahun Akademik dan Periode Akademik ini sudah ada!');
            return redirect()->to('//pages/siklus/edit/' . $id);
        }

        $this->tahunperiodeModel->update($id, [
            'tahun' => $tahun,
            'periode' => $periode,
        ]);

        session()->setFlashdata('pesan', 'Data Siklus Berhasil diupdate!');
        return redirect()->to('/siklus');
    }

    public function delete($id)
    {
        $siklus = $this->tahunperiodeModel->find($id);

        if (!$siklus) {
            return redirect()->to('/siklus')->with('errors', 'Data Siklus Tidak Ditemukan!');
        }

        // Check if there are related records in the proses_ami table
        $relatedProsesAMI = $this->prosesAMIModel->where('tahun_periode_id', $id)->findAll();

        if (!empty($relatedProsesAMI)) {
            $prosesAMINames = array_column($relatedProsesAMI, 'id');
            $prosesAMIList = implode(', ', $prosesAMINames);

            $errorMessage = "Tidak dapat menghapus data Siklus karena terdapat proses AMI : $prosesAMIList.";
            return redirect()->to('/siklus')->with('error', $errorMessage);
        }

        $this->tahunperiodeModel->delete($id);

        session()->setFlashdata('pesan', 'Data Siklus Berhasil dihapus!');
        return redirect()->to('/siklus');
    }
}
