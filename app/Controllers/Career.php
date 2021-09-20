<?php

namespace App\Controllers;

class Career extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'DGT - Career',
            'pageTitle' => 'Career',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'career',
            'js' => [
                '<script src='.base_url('assets/js/page/career.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}
