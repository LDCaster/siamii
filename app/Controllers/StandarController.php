<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ButiranModel;
use App\Models\StandarModel;
use App\Models\SubStandarModel;
use App\Models\UnitProdiModel;

class StandarController extends BaseController
{
    protected $standarModel;
    protected $unitprodiModel;
    protected $butiranmutuModel;
    protected $substandarModel;

    public function __construct()
    {
        $this->standarModel = new StandarModel();
        $this->unitprodiModel = new UnitProdiModel();
        $this->butiranmutuModel = new ButiranModel();
        $this->substandarModel = new SubStandarModel();
    }

    public function index()
    {
        $standar = $this->standarModel->getStandarWithUnit();
        $data = [
            'title'     => 'Data Standar',
            'standar'   => $standar
        ];
        return view('pages/standar/index', $data);
    }

    public function create()
    {
        $unit = $this->unitprodiModel->findAll();
        $data = [
            'title' => 'Tambah Standar',
            'validation' => \Config\Services::validation(),
            'unit'   => $unit
        ];
        return view('pages/standar/create', $data);
    }

    public function save()
    {
        $validationRules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Standar Harus Diisi!',
                ]
            ],
            'unit_prodi_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Unit terlebih dahulu!',
                ]
            ],
            'tahun_periode' => [
                'rules' => 'required', // You can customize the rules as needed
                'errors' => [
                    'required' => 'Tahun Periode Harus Diisi!',
                ]
            ]
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($validationRules);

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->standarModel->save([
            'nama' => $this->request->getVar('nama'),
            'unit_prodi_id' => $this->request->getVar('unit_prodi_id'),
            'tahun_periode' => $this->request->getVar('tahun_periode'), // Added the tahun_periode field here
        ]);

        session()->setFlashdata('pesan', 'Data Standar Berhasil ditambahkan!');

        return redirect()->to('/standar');
    }

    public function edit($id)
    {
        $standar = $this->standarModel->find($id);

        if (!$standar) {
            return redirect()->to('/standar')->with('errors', 'Data Standar Tidak Ditemukan!');
        }

        $unit = $this->unitprodiModel->findAll();
        $data = [
            'title' => 'Edit Standar',
            'standar' => $standar,
            'unit' => $unit,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/standar/edit', $data);
    }

    public function update($id)
    {
        $standar = $this->standarModel->find($id);

        if (!$standar) {
            return redirect()->to('/standar')->with('errors', 'Data Standar Tidak Ditemukan!');
        }

        $validationRules = [
            'nama' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Nama Standar Harus Diisi!',
                    // 'is_unique' => 'Nama Standar Sudah ada',
                ]
            ],
            'unit_prodi_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Unit terlebih dahulu!',
                ]
            ],
            'tahun_periode' => [
                'rules' => 'required', // You can customize the rules as needed
                'errors' => [
                    'required' => 'Tahun Periode Harus Diisi!',
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->standarModel->update($id, [
            'nama' => $this->request->getVar('nama'),
            'unit_prodi_id' => $this->request->getVar('unit_prodi_id'),
            'tahun_periode' => $this->request->getVar('tahun_periode'), // Added the tahun_periode field here
        ]);

        session()->setFlashdata('pesan', 'Data Standar Berhasil diupdate!');
        return redirect()->to('/standar');
    }


    public function delete($id)
    {
        $standar = $this->standarModel->find($id);

        if (!$standar) {
            return redirect()->to('/standar')->with('errors', 'Data Standar Tidak Ditemukan!');
        }

        // Check if there are related records in the sub standar table
        $relatedSubStandar = $this->substandarModel->where('standar_id', $id)->findAll();

        if (!empty($relatedSubStandar)) {
            $substandarNames = array_column($relatedSubStandar, 'id');
            $substandarList = implode(', ', $substandarNames);

            $errorMessage = "Tidak dapat menghapus data Standar karena terdapat Sub Standar isi no: $substandarList.";
            return redirect()->to('/standar')->with('error', $errorMessage);
        }

        $this->standarModel->delete($id);

        session()->setFlashdata('pesan', 'Data Standar Berhasil dihapus!');
        return redirect()->to('/standar');
    }
}
