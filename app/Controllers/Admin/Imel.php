<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Imel extends BaseController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data = [
            'title' => 'Email',
            'menu' => 'post',
            'subMenu' => 'email',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH.'/dashboard'),
                'Konten' => '',
                'Imel:active' => '',
            ],
        ];

        return View('admin/imel/vImel', $data);
    }

    public function sendmail()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('imel');

            $name = $this->request->getPost('name', FILTER_SANITIZE_STRING);
            $email = $this->request->getPost('emails', FILTER_SANITIZE_EMAIL);
            $subject = $this->request->getPost('subject', FILTER_SANITIZE_STRING);
            $message = $this->request->getPost('message', FILTER_SANITIZE_STRING);

            $data = [
                'name' => $name,
                'emails' => $email,
                'subject' => $subject,
                'message' => $message,
            ];

            $res = $builder->insert($data);

            if ($res == false) {
                $result = [
                    'status' => '505',
                    'message' => 'Forbidden',
                ];
            } else {
                $result = [
                    'status' => '201',
                    'message' => 'OK',
                ];
            }
        } else {
            $result = [
                'status' => '501',
                'message' => 'NOT AJAX',
            ];
            exit(1);
        }

        echo json_encode($result);
    }
}
