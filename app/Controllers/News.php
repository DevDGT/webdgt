<?php

namespace App\Controllers;

class News extends BaseController
{

    function __construct()
    {
        $this->api = new \App\Models\ApiModel();
        $this->apiPath = base_url(API_PATH);
    }

    public function index()
    {
        $page = $_REQUEST['page'] ?? 1;
        $jsonData = $this->api->get($this->apiPath . "/public/get/article?limit=5&page=$page");
        $newsData = json_decode($jsonData);
        $data = [
            'title' => 'News',
            'pageTitle' => 'News',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'news',
            'newsData' => $newsData->data ?? [],
            'js' => [
                "<script src=" . base_url('assets/js/page/sidebars.js') . " defer></script>",
                // "<script src=" . base_url('assets/js/page/news.js') . " defer></script>",
            ]

        ];

        echo view('front/canvas', $data);
    }

    public function article()
    {
        $uri = service('uri');
        $slug = $uri->getSegment(2);
        $jsonData = $this->api->get($this->apiPath . "/public/get/article?slug=$slug&detail=true");
        $newsData = json_decode($jsonData);
        $data = [
            'title' => $newsData->data[0]->title ?? "",
            'pageTitle' => $newsData->data[0]->title ?? "",
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'article',
            'newsData' => $newsData->data ?? [],
            'js' => [
                "<script src=" . base_url('assets/js/page/sidebars.js') . " defer></script>",
                // "<script src=" . base_url('assets/js/page/detailsNews.js') . " defer></script>",
            ]

        ];

        echo view('front/canvas', $data);
    }
}
