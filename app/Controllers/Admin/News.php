<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class News extends BaseController
{
    function __construct()
    {
        $this->table = "news";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Artikel',
            'menu' => 'post',
            'subMenu' => 'artikel',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Post' => '',
                'Artikel:active' => '',
            ]
        ];
        return View('admin/article/vArticle', $data);
    }
}
