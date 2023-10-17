<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuditorAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->to('login');
        }

        $userRole = session('role');

        // Jika user adalah auditee, larang akses ke halaman CMS.
        if ($userRole === 'auditee') {
            return redirect()->to('unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
