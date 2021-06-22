<?php

namespace App\Controllers;

class News extends BaseController
{

    function __construct()
    {
        $this->api = new \App\Models\ApiModel();
        $this->apiPath = base_url(API_PATH);
    }

    public function index($page = 1)
    {
        $url = [
            'api' => "/public/get/article?limit=5&page=#page",
            'pagination' => "news/page/#page"
        ];
        $this->getNews($url, $page);
    }

    public function byCategory($category, $page = 1)
    {
        $url = [
            'api' => "/public/get/article?limit=5&category=#catOrTag&page=#page",
            'pagination' => "news/category/#catOrTag/page/#page"
        ];
        $this->getNews($url, $page, $category);
    }

    public function byTags($tags, $page = 1)
    {
        $url = [
            "api" => "/public/get/article?limit=5&tags=#catOrTag&page=#page",
            'pagination' => "news/tags/#catOrTag/page/#page"
        ];
        $this->getNews($url, $page, $tags);
    }

    private function getNews($url, $page, $catOrTag = "")
    {
        $pageNext = intval($page) + 1;
        $jsonData = $this->api->get($this->apiPath . str_replace(['#catOrTag', '#page'], [$catOrTag, $page], $url['api']));
        $cekNext = json_decode($this->api->get($this->apiPath . str_replace(['#catOrTag', '#page'], [$catOrTag, $pageNext], $url['api'])))->count;
        $newsData = json_decode($jsonData);
        $paginationUrl = base_url(str_replace('#catOrTag', $catOrTag, $url['pagination']));
        $data = [
            'title' => 'News',
            'pageTitle' => 'News',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'news',
            'page' => [
                'url' => $paginationUrl,
                'current' => $page,
                'next' => $cekNext
            ],
            'newsData' => $newsData->data ?? [],
            'js' => [
                "<script src=" . base_url('assets/js/page/sidebars.js') . " defer></script>",
                "<script src=" . base_url('assets/js/page/news.js') . " defer></script>",
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
        if ($newsData->count <= 0) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $data = [
            'title' => $newsData->data[0]->title ?? "",
            'pageTitle' => $newsData->data[0]->title ?? "",
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'article',
            'newsData' => $newsData->data ?? [],
            'js' => [
                "<script src=" . base_url('assets/js/page/sidebars.js') . " defer></script>",
                "<script src=" . base_url('assets/js/page/detailsNews.js') . " defer></script>",
            ]

        ];

        echo view('front/canvas', $data);
    }
}
