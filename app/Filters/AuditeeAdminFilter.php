<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuditeeAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->to('login');
        }

        // Dapatkan informasi tentang peran user (auditee/auditor) dari sesi atau database.
        $userRole = session('role');

        // Jika user adalah auditor, larang akses ke halaman CMS.
        if ($userRole === 'auditor') {
            return redirect()->to('unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
