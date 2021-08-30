<?php

namespace App\Controllers;

class Faqs extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Faq',
            'pageTitle' => 'Faq',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'faqs',
            'js' => [
                //'<script src='.base_url('assets/js/page/contact.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}