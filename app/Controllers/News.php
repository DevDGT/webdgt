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
            'js' => 'news.js'
        ];

        echo view('front/canvas', $data);
    }

    public function article()
    {
        $uri = service('uri');
        $data = [
            'title' => 'Title News',
            'pageTitle' => 'Title News',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'article',
            'slug' => $uri->getSegment(2),
            'js' => 'detailsNews.js'
        ];

        echo view('front/canvas', $data);
    }
}
