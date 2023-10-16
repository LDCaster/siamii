<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EvaluasiPelaporanModel;
use App\Models\HAMIModel;
use App\Models\ProsesAMIModel;
use App\Models\StandarModel;
use App\Models\TahunPeriodeModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProsesAMIController extends BaseController
{
    protected $prosesAMIModel;
    protected $tahunperiodeModel;
    protected $standarModel;
    protected $hamiModel;
    protected $userModel;
    protected $evaluasiModel;

    public function __construct()
    {
        $this->prosesAMIModel = new ProsesAMIModel();
        $this->tahunperiodeModel = new TahunPeriodeModel();
        $this->standarModel = new StandarModel();
        $this->hamiModel = new HAMIModel();
        $this->userModel = new UserModel();
        $this->evaluasiModel = new EvaluasiPelaporanModel();
    }

    public function index()
    {
        $prosesAmi = $this->prosesAMIModel->getProsesAMI();

        $data = [
            'title' => 'Proses AMI',
            'prosesAMI' => $prosesAmi
        ];

        return view('pages/ami/proses/index', $data);
    }

    public function toggleStatus($id)
    {
        // Check if the record with the given $id exists
        $prosesAMI = $this->prosesAMIModel->find($id);

        if (!$prosesAMI) {
            // Handle the case where the record doesn't exist
            $response = [
                'success' => false,
                'message' => 'Proses AMI not found.'
            ];
            return $this->response->setJSON($response);
        }

        // Toggle the status (assuming 'status' is the field you want to toggle)
        $newStatus = $prosesAMI['status'] == '1' ? '0' : '1';

        // Update the record with the new status
        $this->prosesAMIModel->update($id, ['status' => $newStatus]);

        // Prepare the response
        $response = [
            'success' => true,
            'status' => $newStatus
        ];

        if ($newStatus == '0') {
            // If the status is 0, redirect to the 'proses-ami' page
            return redirect()->to('/proses-ami');
        }

        return redirect()->to('/proses-ami');
    }


    public function create()
    {
        $siklus = $this->tahunperiodeModel->findAll();
        $standar = $this->standarModel->findAll();
        $users = $this->userModel->getAuditors();

        $data = [
            'title' => 'Tambah Proses AMI',
            'validation' => \Config\Services::validation(),
            'siklus'   => $siklus,
            'standar'   => $standar,
            'users'   => $users,
        ];
        return view('pages/ami/proses/create', $data);
    }

    public function save()
    {
        $validationRules = [
            'tahun_periode_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Siklus Harus Diisi!',
                ],
            ],
            'standar_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Standar Harus Diisi!',
                ],
            ],
            'auditor_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Auditor Harus Diisi!',
                ],
            ],
            'tgl_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Mulai Harus Diisi!',
                ],
            ],
            'tgl_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Selesai Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $siklus = $this->request->getVar('tahun_periode_id');
        $standar = $this->request->getVar('standar_id');
        $auditor = $this->request->getVar('auditor_id');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');


        // Check if the combination of 'siklus' and 'standar' already exists in the database
        $existingData = $this->prosesAMIModel->where([
            'tahun_periode_id' => $siklus,
            'standar_id' => $standar,
            'auditor_id' => $auditor,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
        ])->first();

        if ($existingData) {
            // If the combination already exists, return with an error message
            session()->setFlashdata('pesan', 'Data Proses AMI ini sudah ada!');
            return redirect()->to('/proses-ami/create');
        }

        $this->prosesAMIModel->save([
            'tahun_periode_id' => $siklus,
            'standar_id' => $standar,
            'auditor_id' => $auditor,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
        ]);

        session()->setFlashdata('pesan', 'Data Proses AMI Berhasil ditambahkan!');
        return redirect()->to('/proses-ami');
    }

    public function edit($id)
    {
        $prosesAMI = $this->prosesAMIModel->find($id);
        // dd($prosesAMI);
        $users = $this->userModel->getAuditors();
        // dd($users);
        if (!$prosesAMI) {
            return redirect()->to('/proses-ami')->with('error', 'Data Proses AMI tidak ditemukan!');
        }

        $siklus = $this->tahunperiodeModel->findAll();
        $standar = $this->standarModel->findAll();

        $data = [
            'title' => 'Edit Proses AMI',
            'validation' => \Config\Services::validation(),
            'prosesAMI' => $prosesAMI,
            'siklus' => $siklus,
            'standar' => $standar,
            'users' => $users,
        ];

        return view('pages/ami/proses/edit', $data);
    }

    public function update($id)
    {
        $prosesAMI = $this->prosesAMIModel->find($id);

        if (!$prosesAMI) {
            return redirect()->to('/proses-ami')->with('error', 'Data Proses AMI tidak ditemukan!');
        }

        $validationRules = [
            'tahun_periode_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Siklus Harus Diisi!',
                ],
            ],
            'standar_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Standar Harus Diisi!',
                ],
            ],
            'auditor_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Auditor Harus Diisi!',
                ],
            ],
            'tgl_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Mulai Harus Diisi!',
                ],
            ],
            'tgl_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Selesai Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $siklus = $this->request->getVar('tahun_periode_id');
        $standar = $this->request->getVar('standar_id');
        $auditor = $this->request->getVar('auditor_id');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');

        // Check if the combination of 'siklus' and 'standar' already exists in the database
        $existingData = $this->prosesAMIModel->where('id !=', $id)
            ->where([
                'tahun_periode_id' => $siklus,
                'standar_id' => $standar,
                'auditor_id' => $auditor,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
            ])->first();

        if ($existingData) {
            // If the combination already exists, return with an error message
            session()->setFlashdata('pesan', 'Data Proses AMI ini sudah ada!');
            return redirect()->to("/proses-ami/edit/$id");
        }

        $this->prosesAMIModel->update($id, [
            'tahun_periode_id' => $siklus,
            'standar_id' => $standar,
            'auditor_id' => $auditor,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
        ]);

        session()->setFlashdata('pesan', 'Data Proses AMI Berhasil diupdate!');
        return redirect()->to('/proses-ami');
    }

    public function delete($id)
    {
        // Find the Proses AMI record by ID
        $prosesAMI = $this->prosesAMIModel->find($id);

        // Check if the record exists
        if (!$prosesAMI) {
            return redirect()->to('/proses-ami')->with('error', 'Data Proses AMI tidak ditemukan!');
        }

        $relatedHAMI = $this->hamiModel->where('proses_ami_id', $id)->findAll();

        // Check if there are related records in any of the tables
        if (!empty($relatedHAMI)) {
            $errorMessages = "Data Proses AMI tidak dapat dihapus karena terdapat data terkait di Hasil Audit Mutu Internal.";
            return redirect()->to('/proses-ami')->with('error', $errorMessages);
        }

        // Delete the Proses AMI record
        $this->prosesAMIModel->delete($id);

        // Set a flash message to indicate successful deletion
        session()->setFlashdata('pesan', 'Data Proses AMI berhasil dihapus!');

        // Redirect back to the Proses AMI index page
        return redirect()->to('/proses-ami');
    }

    public function exportSpreadsheet($id)
    {
        // Load the PHPSpreadsheet library
        $spreadsheet = new Spreadsheet();

        // Create a new worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Set the main header
        $worksheet->setCellValue('B7', 'NO');
        $worksheet->setCellValue('C7', 'Hasil Audit Mutu Internal (diisi auditee)');
        $worksheet->setCellValue('F7', 'Pelaksanaan Evaluasi Diri (diisi auditee)');
        $worksheet->setCellValue('I7', 'Pelaksanaan AMI (diisi oleh Tim Auditor)');
        $worksheet->setCellValue('M7', 'Tinjauan Manajemen Pengendalian (diisi oleh manajemen PT)');
        $worksheet->setCellValue('Q7', 'Tinjauan Manajemen Peningkatan (diisi oleh TIM SPMI dan disetujui oleh Manajemen PT)');

        $worksheet->mergeCells('B1:P2');
        $worksheet->setCellValue('B3', 'Lembar Kerja Pelaksanaan Audit Mutu Internal dan Rapat Tinjauan Manajemen');
        $styleB3 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $worksheet->getStyle('B3:P3')->applyFromArray($styleB3);

        $worksheet->mergeCells('B3:P3');
        $worksheet->mergeCells('B4:P6');

        $worksheet->mergeCells('B7:B9');
        $worksheet->mergeCells('C7:E8');
        $worksheet->mergeCells('F7:H8');
        $worksheet->mergeCells('I7:L7');
        $worksheet->mergeCells('M7:P7');
        $worksheet->mergeCells('Q7:Q8');

        $cellRange = 'B7:H9';
        $worksheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle($cellRange)->getFill()->getStartColor()->setARGB('82c9c9'); // Blue color

        $cellRange = 'M7:P9';
        $worksheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle($cellRange)->getFill()->getStartColor()->setARGB('abdbe3'); // Blue color

        $cellRange = 'I9';
        $worksheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle($cellRange)->getFill()->getStartColor()->setARGB('efc3c3'); // pink color

        $cellRange = 'J9:K9';
        $worksheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle($cellRange)->getFill()->getStartColor()->setARGB('f4d7d7'); // pink tipis color

        $cellRange = 'Q7:Q9';
        $worksheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle($cellRange)->getFill()->getStartColor()->setARGB('93d293'); // ijo color

        // Apply style to the main header
        $styleMainHeader = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];

        $worksheet->getStyle('B7:Q7')->applyFromArray($styleMainHeader);

        // set the subheader 1
        $worksheet->setCellValue('I8', 'Audit Dokumen (Tim Auditor AMI saja, belum melibatkan Auditee)');
        $worksheet->setCellValue('J8', 'Audit Lapangan (Tim Auditor AMI dan Auditee)');
        $worksheet->setCellValue('L8', 'Penyusunan Laporan AMI');

        // Apply style to the subheader 1
        $styleSubHeader1 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];

        $worksheet->getStyle('I8:L8')->applyFromArray($styleSubHeader1);

        // Set the subheader 2
        $worksheet->setCellValue('C9', 'Standar SPMI/Referensi Eksternal');
        $worksheet->setCellValue('D9', 'Pernyataan Ayat/Butir Mutu');
        $worksheet->setCellValue('E9', 'Indikator dan Target');
        $worksheet->setCellValue('F9', 'Status Ketercapaian Standar dalam ED (Terlampaui/Tercapai/Tidak Tercapai)');
        $worksheet->setCellValue('G9', 'Status Ketercapaian Standar dalam ED (Terlampaui/Tercapai/Tidak Tercapai)');
        $worksheet->setCellValue('H9', 'Bukti ED (narasi penjelasan fakta)');
        $worksheet->setCellValue('I9', 'Hasil Audit Dokumen dan Daftar Tilik');
        $worksheet->setCellValue('J9', 'Hasil Temuan Audit/Visitasi Lapangan');
        $worksheet->setCellValue('K9', 'Status Temuan (Terlampaui/Tercapai/Tidak Tercapai)');
        $worksheet->setCellValue('L9', 'Rekomendasi');
        $worksheet->setCellValue('M9', 'Important/Not Important');
        $worksheet->setCellValue('N9', 'Urgent/Not Urgent');
        $worksheet->setCellValue('O9', 'Rencana Tindak Lanjut Siklus Berikutnya');
        $worksheet->setCellValue('P9', 'Anggaran/Non Anggaran');
        $worksheet->setCellValue('Q9', 'Perubahan Dokumen Standar');

        // Apply style to the subheader 2
        $styleSubHeader2 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];

        $worksheet->getStyle('C9:Q9')->applyFromArray($styleSubHeader2);
        // Retrieve your data and populate the $Data with it
        $Data = $this->hamiModel->exportExcelProsesAMI($id);
        // $Data[0]['nama_standar']
        // dd($Data);
        $row = 10;
        $counter = 1;
        foreach ($Data as $data) {
            $worksheet->setCellValue('B' . $row, $counter);
            $worksheet->setCellValue('D' . $row, strip_tags($data['butiran_mutu_isi']));
            $worksheet->setCellValue('E' . $row, $data['indikator_target']);
            $worksheet->setCellValue('F' . $row, $data['status_ketercapaian']);
            $worksheet->setCellValue('G' . $row, $data['hasil_evaluasi_diri']);
            $worksheet->setCellValue('H' . $row, $data['bukti_evaluasi_diri']);
            $worksheet->setCellValue('I' . $row, $data['hasil_audit_dokumen']);
            $worksheet->setCellValue('J' . $row, $data['hasil_temuan_audit']);
            $worksheet->setCellValue('K' . $row, $data['status_temuan']);
            $worksheet->setCellValue('L' . $row, $data['hasil_rekomendasi']);

            // Set vertical alignment and wrap text for the current row
            $worksheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $worksheet->getStyle('B' . $row . ':Q' . $row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $worksheet->getStyle('B' . $row . ':Q' . $row)->getAlignment()->setWrapText(true);


            $row++;
            $counter++;
        }

        // Add borders to the cells
        $lastRow = $row;
        $lastColumn = 'Q';

        // Define a border style
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Black border color
                ],
            ],
        ];

        $cellRange = "B7:$lastColumn$lastRow";
        $worksheet->getStyle($cellRange)->applyFromArray($styleArray);


        // Set column widths
        $columnWidths = [
            'A' => 1.67,
            'B' => 5.17,
            'C' => 23.53,
            'D' => 60.83,
            'E' => 44.33,
            'F' => 24,
            'G' => 42,
            'H' => 44.33,
            'I' => 80.50,
            'J' => 41.67,
            'K' => 28.33,
            'L' => 27.33,
            'M' => 19.17,
            'N' => 21.67,
            'O' => 26.17,
            'P' => 31.83,
            'Q' => 38.50,
        ];

        foreach ($columnWidths as $column => $width) {
            $worksheet->getColumnDimension($column)->setWidth($width);
        }

        // Set row heights
        $rowHeights = [
            7 => 14.25,
            8 => 32.25,
            9 => 62.25,
        ];

        foreach ($rowHeights as $row => $height) {
            $worksheet->getRowDimension($row)->setRowHeight($height);
        }

        // Set the MIME type for the response
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $standarName = ''; // Ini akan menjadi nama file default jika tidak ada data nama_standar yang ditemukan

        // Pastikan ada data dan data nama_standar tersedia
        if (!empty($Data) && isset($Data[0]['nama_standar'])) {
            $standarName = 'Standar ' . $Data[0]['nama_standar'];
        }

        // Hapus karakter yang tidak valid dari nama file
        $standarName = preg_replace('/[\/:*?"<>|]/', '', $standarName);

        // Buat nama file yang unik dengan timestamp
        $timestamp = date('Y-m-d_His');
        $filename = $standarName . '_' . $timestamp . '.xlsx';

        // Set the MIME type for the response
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // Set the file name
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create an Xlsx writer and save the spreadsheet to PHP output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
