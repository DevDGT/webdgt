<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
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
                '<script src='.base_url('assets/js/page/product.js').' defer></script>',
            ],
        ];
        echo view('front/canvas', $data);
    }

    public function detail()
    {
        $uri = service('uri');
        $slug = $uri->getSegment(3);
        $jsonData = $this->api->get($this->apiPath.'/public/get/products?slug='.$slug);
        $productsData = json_decode($jsonData);
        if ($productsData->count <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Detail Product',
            'pageTitle' => 'Detail Product',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'detailProduct',
            'productsData' => $productsData->data ?? [],
            'detailProduct' => $productsSubData->data ?? [],
            'js' => [
                '<script src='.base_url('assets/js/page/detailProduct.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }

    private function _randomStrings($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function read()
    {
        $slug = $_GET['file'];
        $jsonData = $this->api->get($this->apiPath.'/public/get/products-file/'.$slug);
        $productsData = json_decode($jsonData);
        if ($productsData->count <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $file = $productsData->data[0]->file;
        $names = $productsData->data[0]->title;
        $files = base_url('/uploads/products/brosur/'.$file);

        // echo '<pre>';
        // print_r($jsonData);
        // echo'</pre>';

        $data = [
            'title' => 'Catalog Product',
            'pageTitle' => 'Catalog Product',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'pdf',
            'productsData' => $files,
            'productsTitle' => $names,
            'prev' => previous_url(true),
            'js' => null,
        ];
        echo view('front/canvas', $data);

    }
}