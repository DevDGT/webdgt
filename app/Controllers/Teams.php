<?php

namespace App\Controllers;

class Teams extends BaseController
{
    public function __construct()
    {
        $this->api = new \App\Models\ApiModel();
        $this->apiPath = base_url(API_PATH);
    }

    public function index()
    {
        $uris = parse_url($_SERVER['REQUEST_URI']);
        parse_str($uris['query'], $params);
        // print_r($params['onweb']);
        $detail = $params['onweb'];

        if ($detail === 'true') {
            $data = [
            'title' => 'Teams Us',
            'pageTitle' => 'Teams Us',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'Teams',
            'js' => [
                '<script src='.base_url('assets/js/page/teams.js').' defer></script>',
            ],
        ];

            echo view('front/canvas', $data);
        } else {
            $uname = $params['name'];
            $jsonData = $this->api->get($this->apiPath.'/public/get/teams-page?username='.$uname);
            $newsData = json_decode($jsonData);
            if ($newsData->data === null) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            // print_r($newsData);
            echo '<style>'.$newsData->data->css.'</style>';
            echo $newsData->data->html;
            echo '<script>'.$newsData->data->js.'</script>';
        }
    }
}