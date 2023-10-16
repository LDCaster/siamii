<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ButiranModel;
use App\Models\StandarModel;
use App\Models\SubStandarModel;

class ButiranController extends BaseController
{
    protected $butiranModel;
    protected $standarModel;
    protected $substandarModel;

    public function __construct()
    {
        $this->butiranModel = new ButiranModel();
        $this->standarModel = new StandarModel();
        $this->substandarModel = new SubStandarModel();
    }

    public function index()
    {
        $butiran = $this->butiranModel->getButiranWithStandar();
        $data = [
            'title'     => 'Data Butiran',
            'butiran'   => $butiran
        ];
        return view('pages/butiran/index', $data);
    }

    public function create()
    {
        $standar = $this->standarModel->findAll();
        $substandar = $this->substandarModel->findAll();

        $data = [
            'title' => 'Tambah Butiran',
            'standar' => $standar,
            'substandar' => $substandar,
            'validation' => \Config\Services::validation()
        ];
        return view('pages/butiran/create', $data);
    }


    public function getSubStandar($subId)
    {
        // Gantilah "ModelAnda" dengan nama model yang sesuai
        $subStandar = $this->substandarModel->getDataByStandarId($subId);

        // Kembalikan data dalam format JSON
        return $this->response->setJSON($subStandar);
    }

    public function save()
    {
        $validationRules = [
            'nama_sub' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sub Standar Harus di isi!',
                ]
            ],
            'butiran_mutu_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Butiran Mutu Harus di isi!',
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->butiranModel->save([
            'sub_standar_id' => $this->request->getVar('nama_sub'),
            'butiran_mutu_isi' => $this->request->getVar('butiran_mutu_isi'),
        ]);

        session()->setFlashdata('pesan', 'Data Isi Butiran Berhasil di tambahkan!');
        return redirect()->to('/butiran');
    }



    public function edit($id)
    {
        $isi = $this->butiranModel->getButiranWithStandarFind($id);
        // dd($isi);

        if (!$isi) {
            return redirect()->to('/butiran')->with('errors', 'Data Isi Butiran Tidak Ditemukan!');
        }
        $standar = $this->standarModel->findAll();
        $substandar = $this->substandarModel->findAll();
        // dd($isi);
        $data = [
            'title' => 'Edit Isi Butiran',
            'isi' => $isi,
            'standar' => $standar,
            'substandar' => $substandar,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/butiran/edit', $data); // Hapus tanda '/' di depan 'butiran/edit'
    }


    public function update($id)
    {
        $isi = $this->butiranModel->find($id);

        if (!$isi) {
            return redirect()->to('/butiran')->with('errors', 'Data Isi Butiran Tidak Ditemukan!');
        }

        $validationRules = [
            // 'nama_sub' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Standar Harus di isi!',
            //     ]
            // ],
            'butiran_mutu_isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Butiran Mutu Harus di isi!',
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->butiranModel->update($id, [
            'sub_standar_id' => $this->request->getVar('nama_sub'),
            'butiran_mutu_isi' => $this->request->getVar('butiran_mutu_isi'),
        ]);

        session()->setFlashdata('pesan', 'Data Isi Butiran Berhasil diupdate!');
        return redirect()->to('/butiran');
    }

    public function delete($id)
    {
        $isi = $this->butiranModel->find($id);

        if (!$isi) {
            return redirect()->to('/butiran')->with('errors', 'Data Isi Butiran Tidak Ditemukan!');
        }

        $this->butiranModel->delete($id);

        session()->setFlashdata('pesan', 'Data Isi Butiran Berhasil dihapus!');
        return redirect()->to('/butiran');
    }
}
