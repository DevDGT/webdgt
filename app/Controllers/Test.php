<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function test()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.1.25/web/public/api/test',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        // pake jquery  itu keur naon ?
        // eaaaa ibnu baik, sebentar ajig

        $data = [
            'title' => 'Test',
            'pageTitle' => 'Test Api',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'test',
            'js' => '',
            // 'apis' => $response
        ];

        echo view('front/canvas', $data);
    }
}
