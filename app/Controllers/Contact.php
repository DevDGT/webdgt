<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Contact Us',
            'pageTitle' => 'Contact Us',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'contact',
            'js' => [
                //'<script src='.base_url('assets/js/page/abouts.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}