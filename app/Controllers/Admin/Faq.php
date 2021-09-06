<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Faq extends BaseController
{
    public function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = 'faq';
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Faq',
            'menu' => 'post',
            'subMenu' => 'faq',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH.'/dashboard'),
                'Konten' => '',
                'Faq:active' => '',
            ],
        ];

        return View('admin/faq/vFaq', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'question' => 'required|min:3',
                'id_category' => 'required',
                'answers' => 'required|min:3',
            ], [
                'slug' => slug(Input_('question')),
            ]);
            $cat = $this->db->table($this->table)->select('question')->where('question', str_replace(' ', '-', strtolower(Input_('question'))))->get()->getRow();
            if ($cat) {
                $validate = ValidateAdd($validate, 'question', 'Pertanyaan sudah ada');
            }
            if (!$validate['success']) {
                throw new \Exception('Error Processing Request');
            }
            $idCategory = $this->db->table('category_faq')->where(EncKey('id'), Input_('id_category'))->get()->getRow();
            $validate['data']['id_category'] = $idCategory->id;
            if (!Create($this->table, Guard($validate['data'], ['id', 'token']))) {
                throw new \Exception('Gagal memasukan data !');
            }
            $message = [
                'status' => 'ok',
                'message' => 'Berhasil memasukan data',
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
            $message = array_merge($message, ['validate' => $validate, 'validate' => $validate]);
            echo json_encode($message);
        }
    }

    public function update()
    {
        try {
            $validate = Validate([
                'question' => 'required|min:3',
                'answers' => 'required|min:3',
            ]);
            $cat = $this->db->table($this->table)->select('id, question')->where('question', str_replace(' ', '-', strtolower(Input_('question'))))->get()->getRow();
            if ($cat && Enc($cat->id) != Input_('id')) {
                $validate = ValidateAdd($validate, 'question', 'Pertanyaan sudah ada');
            }
            $idCategory = $this->db->table('category_faq')->where(EncKey('id'), Input_('id_category'))->get()->getRow();
            $validate['data']['id_category'] = $idCategory->id;
            if (!$validate['success']) {
                throw new \Exception('Error Processing Request');
            }
            if (!Update($this->table, $validate['data'], [EncKey('id') => Input_('id')])) {
                throw new \Exception('Tidak ada perubahan');
            }
            $message = [
                'status' => 'ok',
                'message' => 'Berhasil merubah data',
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
            $message = array_merge($message, ['validate' => $validate, 'modalClose' => true]);
            echo json_encode($message);
        }
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

    public function deleteMultiple()
    {
        try {
            if (!isset($_POST['dataId'])) {
                throw new \Exception('no param');
            }
            $dataId = explode(',', Input_('dataId'));

            $jmlSukses = 0;
            foreach ($dataId as $key) {
                if (Delete($this->table, [EncKey('id') => $key])) {
                    ++$jmlSukses;
                }
            }

            $message = [
                'status' => 'ok',
                'message' => "Berhasil menghapus <b>$jmlSukses</b> data dari <b>".count($dataId).'</b> data',
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

    public function set_($id = '')
    {
        try {
            if ($id == '') {
                throw new \Exception('no param');
            }
            $status = $this->req->getPost('status') == 'on' ? '1' : '0';

            if (Update($this->table, ['active' => $status], [EncKey('id') => $id]) == false) {
                throw new \Exception('Gagal merubah status');
            }
            $message = [
                'status' => 'ok',
                'message' => 'Berhasil merubah status',
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

    public function setMultiple()
    {
        try {
            if (!isset($_POST['dataId'])) {
                throw new \Exception('no param');
            }
            if (!isset($_POST['action'])) {
                throw new \Exception('missing param');
            }
            $dataId = explode(',', Input_('dataId'));
            $status = Input_('action') == 'active' ? '1' : '0';
            $jmlSukses = 0;

            foreach ($dataId as $key) {
                if (Update($this->table, ['active' => $status], [EncKey('id') => $key])) {
                    ++$jmlSukses;
                }
            }

            $message = [
                'status' => 'ok',
                'message' => "Berhasil merubah status <b>$jmlSukses</b> data dari <b>".count($dataId).'</b> data',
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
}
