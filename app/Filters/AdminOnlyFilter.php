<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminOnlyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->to('login');
        }
        $userRole = session('role'); // Anda perlu mengganti ini dengan cara Anda mendapatkan informasi peran user.

        // Jika user adalah auditee atau auditor, larang akses ke halaman CMS.
        if ($userRole === 'auditee' || $userRole === 'auditor') {
            return redirect()->to('unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
