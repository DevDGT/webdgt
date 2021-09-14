<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class Imel extends BaseController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->table = 'imel';
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Email',
            'menu' => 'post',
            'subMenu' => 'email',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH.'/dashboard'),
                'Konten' => '',
                'Imel:active' => '',
            ],
        ];

        return View('admin/imel/vImel', $data);
    }

    public function delete()
    {
        try {
            if (!isset($_POST['id'])) {
                throw new \Exception('no param');
            }
            $id = Input_('id');

            if (Delete($this->table, [EncKey('id') => $id]) == false) {
                throw new \Exception('Gagal menghapus data');
            }
            $message = [
                'status' => 'ok',
                'message' => 'Berhasil menghapus data',
            ];
        } catch (\Throwable $th) {
            $message = [
                'status' => 'fail',
                'message' => $th->getMessage(),
            ];
        } catch (\Exception $ex) {
            $message = [
                'status' => 'fail',
                'message' => $ex->getMessage(),
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function sendmail()
    {
        if ($this->request->isAJAX()) {

            $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response')) ;

            // $userIp = $this->request->ip_address();
                
            $db = \Config\Database::connect();
            $builder = $db->table('imel');

            $name = $this->request->getPost('name', FILTER_SANITIZE_STRING);
            $email = $this->request->getPost('emails', FILTER_SANITIZE_EMAIL);
            $subject = $this->request->getPost('subject', FILTER_SANITIZE_STRING);
            $message = $this->request->getPost('message', FILTER_SANITIZE_STRING);

            $data = [
                'name' => $name,
                'emails' => $email,
                'subject' => $subject,
                'message' => $message,
            ];

            $res = $builder->insert($data);

            if ($res == false) {
                $result = [
                    'status' => '505',
                    'message' => 'Forbidden',
                ];
            } else {
                $result = [
                    'status' => '201',
                    'message' => 'OK',
                ];
            }

        } else {
            $result = [
                'status' => '501',
                'message' => 'NOT AJAX',
            ];
            exit(1);
        }

        echo json_encode($result);
    }

    public function sendinbox()
    {
        // print_r($_POST);
        $to = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
        $subject = $this->request->getVar('subject', FILTER_SANITIZE_STRING);
        $message = $this->request->getVar('pesana');

        $email = \Config\Services::email();
        
        $email->clear(true);

        $email->setFrom('info@dianglobaltech.co.id', 'Info Dian Global Tech');
        $email->setTo($to);
        
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send(false)) 
		{
            $result['status'] = '200';
            $result['message'] = 'Email successfully sent';
        } else {
            $result['status'] = '501';
            $result['message'] = $email->printDebugger(['headers','subject', 'body']);
            // print_r($data);
        }

        echo json_encode($result);
    }

    private function _capthca($response){
        $secret = '6LffYGYcAAAAAOk_zaa9s96vXkCp2lP2xCbk_VbA';

        $credential = array(
            'secret' => $secret,
            'response' => $this->request->getVar('g-recaptcha-response')
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
    
        $status= json_decode($response, true);
        
        if($status['success']){
            return true;
        }else{
            return false;
        }
    }

}
