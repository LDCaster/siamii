<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StandarModel;
use App\Models\UnitProdiModel;

class UnitController extends BaseController
{
    protected $unitprodiModel;
    protected $standarModel;

    public function __construct()
    {
        $this->standarModel = new StandarModel();
        $this->unitprodiModel = new UnitProdiModel();
    }

    public function index() // tampil halaman unit-prodi
    {
        $unitprodi = $this->unitprodiModel->findAll();

        $data = [
            'title' => 'Data Unit',
            'unitprodi' => $unitprodi
        ];

        return view('pages/unitprodi/index', $data);
    }

    public function create() // tampil halaman tambah unit-prodi
    {
        $data = [
            'title' => 'Tambah Data Unit',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/unitprodi/create', $data);
    }

    public function save() // aksi tambah (simpan) data unit-prodi
    {
        $validationRules = [
            'nama' => [
                'rules' => 'required|is_unique[unit_prodi.nama]',
                'errors' => [
                    'required' => 'Nama Unit Harus Diisi!',
                    'is_unique' => 'Nama Unit Sudah ada',
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->unitprodiModel->save([
            'nama' => $this->request->getVar('nama')
        ]);

        session()->setFlashdata('pesan', 'Data Unit Berhasil di tambahkan!');

        return redirect()->to('/unit');
    }


    public function edit($id) // tampil halaman ubah data unit-prodi
    {
        $unit = $this->unitprodiModel->find($id);
        if (!$unit) {
            return redirect()->to('/unit')->with('error', 'Data Unit tidak ditemukan');
        }

        $data = [
            'title' => 'Ubah Data Unit',
            'unit' => $unit
        ];

        return view('pages/unitprodi/edit', $data);
    }

    public function update($id)
    {
        $unit = $this->unitprodiModel->find($id);

        if (!$unit) {
            return redirect()->to('/unit')->with('error', 'Data Unit tidak ditemukan');
        }

        $validationRules = [
            'nama' => [
                'rules' => 'required|is_unique[unit_prodi.nama]',
                'errors' => [
                    'required' => 'Nama Unit Harus Diisi!',
                    'is_unique' => 'Nama Unit Sudah ada',
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->unitprodiModel->update($id, [
            'nama' => $this->request->getVar('nama')
        ]);

        session()->setFlashdata('pesan', 'Data Unit Berhasil diupdate!');

        return redirect()->to('/unit');
    }

    public function delete($id)
    {
        $unit = $this->unitprodiModel->find($id);

        if (!$unit) {
            return redirect()->to('/unit')->with('error', 'Data Unit tidak ditemukan');
        }

        // Check if there are related standards
        $relatedStandards = $this->standarModel->where('unit_prodi_id', $id)->findAll();

        if (!empty($relatedStandards)) {
            $standarNames = array_column($relatedStandards, 'standar');
            $standarList = implode(', ', $standarNames);

            $errorMessage = "Tidak dapat menghapus data Unit karena terdapat standar terkait: $standarList.";
            return redirect()->to('/unit')->with('error', $errorMessage);
        }

        $this->unitprodiModel->delete($id);

        session()->setFlashdata('pesan', 'Data Unit Berhasil dihapus!');

        return redirect()->to('/unit');
    }
}
