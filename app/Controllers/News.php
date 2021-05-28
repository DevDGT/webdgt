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

    public function article()
    {

        $data = [
            'title' => 'Title News',
            'pageTitle' => 'Title News',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'article',
            'js' => ''
        ];

        echo view('front/canvas', $data);
    }
}
