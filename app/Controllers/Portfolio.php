<?php

namespace App\Controllers;

class Portfolio extends BaseController
{
    public function __construct()
    {
        $this->api = new \App\Models\ApiModel();
        $this->apiPath = base_url(API_PATH);
    }

    public function index()
    {
        $data = [
            'title' => 'Portfolio',
            'pageTitle' => 'Portfolio',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'portfolio',
            'js' => [
                '<script src='.base_url('assets/js/page/portfolio.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}
