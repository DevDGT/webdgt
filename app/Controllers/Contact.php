<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'DGT - Contact',
            'pageTitle' => 'Contact',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'contact',
            'js' => [
                '<script src='.base_url('assets/js/page/contact.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}
