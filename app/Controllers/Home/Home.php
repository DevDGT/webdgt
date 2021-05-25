<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'pageTitle' => 'Beranda',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'dashboard',
        ];

        echo view('front/canvas', $data);
    }

    public function aboutus()
    {
        $data = [
            'title' => 'About',
            'pageTitle' => 'About Us',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'aboutus',
        ];

        echo view('front/canvas', $data);
    }
}
