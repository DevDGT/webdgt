<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Article extends BaseController
{
    function __construct()
    {
        $this->table = "article";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => DATE_NOW,
            'menu' => 'post',
            'subMenu' => 'artikel',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Post' => '',
                'Artikel:active' => '',
            ]
        ];
        return View('admin/article/vArticle', $data);
    }

    public function checkTitle()
    {
        try {
            if (!isPost()) throw new \Exception("Bad Request");
            if (!isset($_POST['title'])) throw new \Exception("Error Processing Request");
            $validate = Validate([
                'title' => 'requred|min:6'
            ]);
            $surat = $this->db->table('article')->select('slug')->where('slug', str_replace(" ", '-', strtolower(Input_('title'))))->get()->getRow();
            if ($surat) $validate = ValidateAdd($validate, 'title', 'Judul sudah digunakan');

            $message = [
                'status' => 'ok',
            ];
        } catch (\Throwable $th) {
            $message = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $message = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            $message = array_merge($message, $validate);
            echo json_encode($message);
        }
    }

    public function store()
    {
        try {
            $validate = Validate([
                'title' => 'required|min:6',
                'category_id' => 'required',
                'tags' => 'required',
                'content' => 'required'
            ], [
                'user_id' => session('userId'),
                'update_by' => session('userId'),
                'slug' => str_replace(" ", "-", Input_('title')),
                'tags' => false
            ]);

            if (!$validate['success']) throw new \Exception("Error Processing Request");
            $categoryId = $this->db->table('category')->select('id')->where([EncKey('id') => Input_('category_id')])->get()->getRow()->id;
            $validate['data']['category_id'] = $categoryId ?? 0;
            if (!Create($this->table, $validate['data'])) throw new \Exception("Gagal memasukan data !");
            $idArticle = $this->db->insertID();
            $articleTags = json_decode(Input_('tags')) ?? [];
            foreach ($articleTags as $cat) {
                $categoryId = $this->db->table('tags')->select('id')->where(EncKey('id'), $cat)->get()->getRow()->id;
                $dataTags[] = [
                    'article_id' => $idArticle,
                    'tags_id' => $categoryId
                ];
            }
            Create('article_tags', $dataTags);
            $message = [
                'status' => 'ok',
                'message' => "Berhasil memasukan data"
            ];
        } catch (\Throwable $th) {
            $message = [
                'status' => 'fail',
                'message' => $th->getMessage() . ", Line : " . $th->getLine() . ", File : " . $th->getFile()
            ];
        } catch (\Exception $ex) {
            $message = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            $message = array_merge($message, ['validate' => $validate]);
            echo json_encode($message);
        }
    }

    public function set_($id = '')
    {
        try {

            if ($id == '') throw new \Exception("no param");

            $status = Input_('status') == "on" ? '1' : '0';

            if (Update($this->table, ['status' => $status], [EncKey('id') => $id]) == false) throw new \Exception("Gagal merubah status");

            $message = [
                'status' => 'ok',
                'message' => 'Berhasil merubah status'
            ];
        } catch (\Throwable $th) {
            $message = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $message = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function delete()
    {
        try {

            if (!isset($_POST['id'])) throw new \Exception("no param");

            $id = Input_('id');

            if (Delete($this->table, [EncKey('id') => $id]) == false) throw new \Exception("Gagal menghapus data");

            $message = [
                'status' => 'ok',
                'message' => 'Berhasil menghapus data'
            ];
        } catch (\Throwable $th) {
            $message = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $message = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function uploads()
    {
        # code...
        echo "uploads";
    }
}
