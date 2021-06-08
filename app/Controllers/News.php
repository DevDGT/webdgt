<?php

namespace App\Controllers;

class News extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'News',
            'pageTitle' => 'News',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'news',
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
        $data = [
            'title' => '',
            'pageTitle' => '',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'article',
            'slug' => $uri->getSegment(2),
            'js' => [
                "<script src=" . base_url('assets/js/page/sidebars.js') . " defer></script>",
                "<script src=" . base_url('assets/js/page/detailsNews.js') . " defer></script>",
            ]

        ];

        echo view('front/canvas', $data);
    }
}
