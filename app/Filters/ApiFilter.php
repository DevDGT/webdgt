<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ApiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if (session('token') && !session('level') == "1") return redirect()->to(ADMIN_PATH);
        if (!session('token')) {
            echo json_encode([
                'status' => 'fail',
                'message' => 'Not Authorized'
            ]);
            exit();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
