<?php

namespace App\Controllers;

class Faqs extends BaseController
{
    public function __construct()
    {
        $this->api = new \App\Models\ApiModel();
        $this->apiPath = base_url(API_PATH);
    }

    public function index()
    {
        $uri = service('uri');
        $slug = $uri->getSegment(3);
        $jsonData = $this->api->get($this->apiPath."/public/get/faq?slug=$slug&detail=true");
        $faqData = json_decode($jsonData);
        if ($faqData->count <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Faq',
            'pageTitle' => 'Faq',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'faqs',
            'faqData' => $faqData->data ?? [],
            'js' => [
                '<script src='.base_url('assets/js/page/faqs.js').' defer></script>',
            ],
        ];

        echo view('front/canvas', $data);
    }
}
