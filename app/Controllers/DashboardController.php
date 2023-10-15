<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProsesAMIModel;
use App\Models\StandarModel;
use App\Models\UnitProdiModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $prosesAMIModel;
    protected $userModel;
    protected $unitprodiModel;
    protected $standarModel;

    public function __construct()
    {
        $this->unitprodiModel = new UnitProdiModel();
        $this->userModel = new UserModel();
        $this->standarModel = new StandarModel();
        $this->prosesAMIModel = new ProsesAMIModel();
    }

    public function index()
    {
        $prosesAMI = $this->prosesAMIModel->countAllResults();
        $user = $this->userModel->countAllResults();
        $unit_prodi = $this->unitprodiModel->countAllResults();
        $standar = $this->standarModel->countAllResults();

        $user_id = session('user_id');
        $unit_prodi_id = session('unit_prodi_id');
        // dd($unit_prodi_id);

        $prosesAMIbyAuditee = $this->prosesAMIModel->getProsesAMIByAuditee($unit_prodi_id);
        $prosesAMIbyAuditor = $this->prosesAMIModel->getProsesAMIByUserid($user_id);
        // dd($prosesAMIbyAuditee);

        $data = [
            'title' => 'Dashboard',
            'prosesAMI' => $prosesAMI,
            'prosesAMIbyAuditee' => $prosesAMIbyAuditee,
            'prosesAMIbyAuditor' => $prosesAMIbyAuditor,
            'user' => $user,
            'unit_prodi' => $unit_prodi,
            'standar' => $standar,
        ];
        return view('pages/dashboard', $data); // Menggunakan view "
    }
}
