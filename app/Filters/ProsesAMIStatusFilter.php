<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\ProsesAMIModel; // Ganti dengan model yang sesuai

class ProsesAMIStatusFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Dapatkan id proses_ami dari URL
        $idProsesAmi = $request->uri->getSegment(3); // Ubah angka 3 sesuai dengan posisi segmen id proses_ami dalam URL

        // Cek status proses_ami dari database
        $prosesAmiModel = new ProsesAMIModel(); // Ganti dengan model yang sesuai
        $prosesAmi = $prosesAmiModel->find($idProsesAmi);

        // Cek juga peran pengguna (role_id)
        $session = session();
        $role_id = $session->get('role'); // Sesuaikan dengan nama session yang Anda gunakan

        if ($prosesAmi && $prosesAmi['status'] == 1 || $role_id == 'admin') {
            // Status proses_ami adalah 1 atau pengguna adalah admin, izinkan akses
            return;
        } else {
            // Status proses_ami bukan 1 dan pengguna bukan admin, tolak akses
            return redirect()->to('unauthorized'); // Ganti dengan halaman error yang sesuai
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah akses
    }
}
