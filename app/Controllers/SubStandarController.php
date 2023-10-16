<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StandarModel;
use App\Models\SubStandarModel;

class SubStandarController extends BaseController
{
    protected $substandarModel;
    protected $standarModel;

    public function __construct()
    {
        $this->substandarModel = new SubStandarModel();
        $this->standarModel = new StandarModel();
    }

    public function index($standarId)
    {
        $substandar = $this->substandarModel->getDataByStandarId($standarId);
        $standar = $this->standarModel->find($standarId);

        $data = [
            'title'     => 'Data Sub Standar',
            'substandar'   => $substandar,
            'standarId' => $standarId,
            'standar' => $standar,
        ];
        return view('pages/standar/sub/index', $data);
    }

    public function create($standarId)
    {
        $standar = $this->standarModel->find($standarId);

        $data = [
            'title' => 'Tambah Data Sub Standar',
            'standarId' => $standarId,
            'standar' => $standar,
        ];

        return view('pages/standar/sub/create', $data);
    }

    public function save()
    {
        // Validasi formulir dan ambil data dari formulir
        $validation = \Config\Services::validation();
        $rules = [
            'nama_sub' => 'required',
            'standar_id' => 'required'
        ];

        if ($this->validate($rules)) {
            // Simpan data sub-standar ke database
            $data = [
                'nama_sub' => $this->request->getPost('nama_sub'),
                'standar_id' => $this->request->getPost('standar_id'),
            ];

            $this->substandarModel->insert($data);

            return redirect()->to(base_url('sub-standar/' . $data['standar_id']))->with('pesan', 'Data Sub Standar berhasil ditambahkan');
        } else {
            return redirect()->to(base_url('sub-standar/create/' . $this->request->getPost('standar_id')))->withInput()->with('error', $validation->listErrors());
        }
    }

    public function edit($subStandarId)
    {
        $substandar = $this->substandarModel->find($subStandarId);

        if (!$substandar) {
            return redirect()->to(base_url('sub-standar/index/' . $subStandarId))->with('error', 'Data Sub Standar tidak ditemukan');
        }

        $data = [
            'title' => 'Ubah Data Sub Standar',
            'substandar' => $substandar,
            'standarId' => $substandar['standar_id'],
        ];

        return view('pages/standar/sub/edit', $data);
    }

    public function update($subStandarId)
    {
        $substandar = $this->substandarModel->find($subStandarId);

        // Validasi formulir dan ambil data dari formulir
        $validation = \Config\Services::validation();
        $rules = [
            'nama_sub' => 'required',
        ];

        if ($this->validate($rules)) {
            // Perbarui data sub-standar ke database
            $data = [
                'nama_sub' => $this->request->getPost('nama_sub'),
            ];

            $this->substandarModel->update($subStandarId, $data);

            return redirect()->to(base_url('sub-standar/' . $substandar['standar_id']))->with('pesan', 'Data Sub Standar berhasil diperbarui');
        } else {
            return redirect()->to(base_url('sub-standar/edit/' . $substandar['standar_id']))->withInput()->with('error', $validation->listErrors());
        }
    }


    public function delete($subStandarId)
    {
        $substandar = $this->substandarModel->find($subStandarId);

        if (!$substandar) {
            return redirect()->to(base_url('sub-standar/' . $substandar['standar_id']))->with('error', 'Data Sub Standar tidak ditemukan');
        }

        $this->substandarModel->delete($subStandarId);

        return redirect()->to(base_url('sub-standar/' . $substandar['standar_id']))->with('pesan', 'Data Sub Standar berhasil dihapus');
    }
}
