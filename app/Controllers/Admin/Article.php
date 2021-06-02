<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Exception;

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
            'title' => "Artikel",
            'menu' => 'post',
            'subMenu' => 'artikel',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Post' => '',
                'Artikel & Berita:active' => '',
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

            $result = [
                'status' => 'ok',
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            $result = array_merge($result, $validate);
            echo json_encode($result);
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
                'slug' => preg_replace('/[^a-zA-Z0-9 -]/', '', str_replace([" ", ".", ","], "-", strtolower(Input_('title')))),
            ]);

            // Print_($validate['data']);

            if (!$validate['success']) throw new \Exception("Error Processing Request");
            $categoryId = $this->db->table('category')->select('id')->where([EncKey('id') => Input_('category_id')])->get()->getRow()->id;
            $validate['data']['category_id'] = $categoryId ?? 0;
            if (!Create($this->table, $validate['data'])) throw new \Exception("Gagal memasukan data !");
            $idArticle = $this->db->insertID();
            $this->uploadCover(['id' => $idArticle]);
            $result = [
                'status' => 'ok',
                'message' => "Berhasil memasukan data"
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage() . ", Line : " . $th->getLine() . ", File : " . $th->getFile()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            $result = array_merge($result, ['validate' => $validate]);
            echo json_encode($result);
        }
    }

    public function set_($id = '')
    {
        try {

            if ($id == '') throw new \Exception("no param");

            $status = Input_('status') == "on" ? '1' : '0';

            if (Update($this->table, ['status' => $status], [EncKey('id') => $id]) == false) throw new \Exception("Gagal merubah status");

            $result = [
                'status' => 'ok',
                'message' => 'Berhasil merubah status'
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function delete()
    {
        try {

            if (!isset($_POST['id'])) throw new \Exception("no param");

            $id = Input_('id');

            if (Delete($this->table, [EncKey('id') => $id]) == false) throw new \Exception("Gagal menghapus data");

            $result = [
                'status' => 'ok',
                'message' => 'Berhasil menghapus data'
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function update()
    {
        try {

            $validate = Validate([
                'title' => 'required|min:6',
                'category_id' => 'required',
                'tags' => 'required',
                'content' => 'required'
            ], [
                'update_by' => session('userId'),
            ]);

            if (!$validate['success']) throw new Exception("Error Processing Request");
            $article = $this->db->table($this->table)->select('id')->where([EncKey('id') => Input_('id')])->get()->getRow();
            if (!$article) throw new Exception("no data");
            $categoryId = $this->db->table('category')->select('id')->where([EncKey('id') => Input_('category_id')])->get()->getRow()->id;
            $validate['data']['category_id'] = $categoryId ?? 0;
            $updateCover = false;
            if ($_FILES['cover']['size'] > 0) {
                $coverOld = $this->db->table($this->table)->select('cover')->where([EncKey('id') => Input_('id')])->get()->getRow()->cover;
                unlink(ROOTPATH . 'public/uploads/cover/' . $coverOld);
                $updateCover = $this->uploadCover([EncKey('id') => Input_('id')]);
            }
            // Print_($updateCover);
            if (!Update($this->table, $validate['data'], [EncKey('id') => Input_('id')]) && !$updateCover) throw new Exception("Tidak ada perubahan");

            $message = [
                'status' => 'ok',
                'message' => "Berhasil merubah data"
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
            $message = array_merge($message, ['validate' => $validate, 'modalClose' => true]);
            echo json_encode($message);
        }
    }

    public function deleteMultiple()
    {
        try {

            if (!isset($_POST['dataId'])) throw new \Exception("no param");

            $dataId = explode(",", Input_('dataId'));

            $jmlSukses = 0;
            foreach ($dataId as $key) {
                if (Delete($this->table, [EncKey('id') => $key])) $jmlSukses++;
            }

            $message = [
                'status' => 'ok',
                'message' => "Berhasil menghapus <b>$jmlSukses</b> data dari <b>" . count($dataId) . "</b> data"
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

    public function setMultiple()
    {
        try {

            if (!isset($_POST['dataId'])) throw new \Exception("no param");
            if (!isset($_POST['action'])) throw new \Exception("missing param");

            $dataId = explode(",", Input_('dataId'));
            $status = Input_('action') == 'active' ? '1' : '0';
            $jmlSukses = 0;

            foreach ($dataId as $key) {
                if (Update($this->table, ['status' => $status], [EncKey('id') => $key])) $jmlSukses++;
            }

            $message = [
                'status' => 'ok',
                'message' => "Berhasil merubah status <b>$jmlSukses</b> data dari <b>" . count($dataId) . "</b> data"
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
        try {

            $validated = $this->validate([
                'upload' => [
                    'rules' => 'uploaded[upload]|mime_in[upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[upload,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Format File Harus Berupa jpg, jpeg, gif, png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ]);

            if ($validated == false) throw new Exception($this->validator->listErrors());
            $file = $this->request->getFile('upload');
            $fileName = time() . "_" . $file->getName();
            $path = ROOTPATH . 'public/uploads/';
            $file->move($path, $fileName);

            $result = [
                "uploaded" => 1,
                "file_name" => $fileName,
                "url" => base_url("/uploads/$fileName")
            ];
        } catch (\Throwable $th) {
            $result = [
                "uploaded" => 0,
                "error" => ['message' => preg_replace('!\s+!', ' ', strip_tags($th->getMessage()))]
            ];
        } catch (\Exception $ex) {
            $result = [
                "uploaded" => 0,
                "error" => ['message' => preg_replace('!\s+!', ' ', strip_tags($ex->getMessage()))]
            ];
        } finally {
            echo json_encode($result);
        }
    }

    private function uploadCover($idArticle = [])
    {
        try {

            $validated = $this->validate([
                'cover' => [
                    'rules' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]|max_size[cover,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Format File Harus Berupa jpg, jpeg, gif, png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ]);

            if ($validated == false) throw new Exception($this->validator->listErrors());
            $file = $this->request->getFile('cover');
            $fileName = time() . "_" . $file->getName();
            $path = ROOTPATH . 'public/uploads/cover/';
            $file->move($path, $fileName);
            $result = Update($this->table, ['cover' => $fileName], $idArticle);;
        } catch (\Throwable $th) {
            $result = [
                "uploaded" => 0,
                "error" => ['message' => preg_replace('!\s+!', ' ', strip_tags($th->getMessage()))]
            ];
        } catch (\Exception $ex) {
            $result = [
                "uploaded" => 0,
                "error" => ['message' => preg_replace('!\s+!', ' ', strip_tags($ex->getMessage()))]
            ];
        } finally {
            return $result;
        }
    }
}
