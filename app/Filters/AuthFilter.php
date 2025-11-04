<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $currentPath = $request->getUri()->getPath();
        
        // Skip untuk halaman yang tidak perlu autentikasi
        if (in_array($currentPath, ['login', 'register', '/'])) {
            return;
        }
        
        // Cek apakah user sudah login
        if (!$session->get('logged_in')) {
            $session->setFlashdata('error', 'Silakan login terlebih dahulu');
            return redirect()->to('/login');
        }
        
        // Cek akses admin
        $userRole = $session->get('role');
        if (strpos($currentPath, 'admin/') === 0 && $userRole !== 'admin') {
            $session->setFlashdata('error', 'Akses ditolak');
            return redirect()->to('/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
