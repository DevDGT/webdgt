<?php

namespace App\Controllers;

class ProductCatalog extends BaseController
{
    public function __construct()
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
                '<script src='.base_url('assets/js/page/product.js').' defer></script>',
            ],
        ];
        // echo 'ok';
        echo view('front/canvas', $data);
    }

    public function detail()
    {
        $uri = service('uri');
        $slug = $uri->getSegment(3);
        $jsonData = $this->api->get($this->apiPath.'/public/get/products?slug='.$slug);
        $productsData = json_decode($jsonData);
        // $jsonSubData = $this->api->get($this->apiPath.'/public/get/products-demo/'.$productsData->data[0]->id);
        // $productsSubData = json_decode($jsonSubData);
        if ($productsData->count <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // echo '<pre>';
        // print_r($productsData->data[0]->id);
        // print_r($slug);
        // print_r($jsonData);
        // echo'</pre>';
        // var_dump($jsonSubData);

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
}