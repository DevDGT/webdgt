<?php

namespace App\Controllers;

class Product extends BaseController
{

    function __construct()
    {
        $this->api = new \App\Models\ApiModel();
        $this->apiPath = base_url(API_PATH);
    }

    public function index()
    {
        // $page = $_REQUEST['page'] ?? 1;
        // $jsonData = $this->api->get($this->apiPath . "/public/get/article?limit=5&page=$page");
        // $newsData = json_decode($jsonData);
        $data = [
            'title' => 'Product',
            'pageTitle' => 'Product',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'product',
            // 'newsData' => $newsData->data ?? [],
            'js' => [
                "<script src=" . base_url('assets/js/page/product.js') . " defer></script>",
            ]

        ];

        echo view('front/canvas', $data);
    }
}
