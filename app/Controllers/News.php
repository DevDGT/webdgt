<?php

namespace App\Controllers;

class News extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'News',
            'pageTitle' => 'News',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'news',
            'js' => ''
        ];

        echo view('front/canvas', $data);
    }
}
