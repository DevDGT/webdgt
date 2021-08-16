<?php

namespace App\Controllers;

class Teams extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Teams Us',
            'pageTitle' => 'Teams Us',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'Teams',
            'js' => [
                '<script src='.base_url('assets/js/page/teams.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}
