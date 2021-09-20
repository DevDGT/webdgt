<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'DGT - IT Consultan',
            'pageTitle' => 'Dashboard',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'dashboard',
            'js' => [
                '<script src='.base_url('assets/js/page/dashboard.js').' defer></script>',
            ],
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
            'js' => 'aboutus.js',
        ];

        echo view('front/canvas', $data);
    }
}