<?php

namespace App\Controllers;

class Abouts extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'About Us',
            'pageTitle' => 'About Us',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'abouts',
            'js' => [
                '<script src='.base_url('assets/js/page/abouts.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}
