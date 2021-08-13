<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Clients extends BaseController
{

    function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = "clients";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Klien',
            'menu' => 'post',
            'subMenu' => 'clients',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Master' => '',
                'Klien:active' => '',
            ]
        ];
        return View('admin/clients/vClients', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'name' => 'required|min:2|max:255|name',
                'description' => 'required|min:15',
            ]);

            $user = $this->db->table($this->table)->where('name', Input_('name'))->get()->getRow();
            if ($user) $validate = ValidateAdd($validate, 'name', 'name ada yang sama');
            if (!$validate['success']) throw new \Exception("Error Processing Request");


            $insertClients = Create($this->table, $validate['data']);
            $idClents = $this->db->insertID();
            $uploadIcon = $this->uploadIcon(["id" => $idClents]);
            if (!$insertClients && !$uploadIcon) throw new \Exception("Gagal memasukan data !");
            $message = [
                'status' => 'ok',
                'message' => "Berhasil memasukan data"
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
            $message = array_merge($message, ['validate' => $validate]);
            echo json_encode($message);
        }
    }

    public function update()
    {
        try {
            $validate = Validate([
                'id' => 'required',
                'name' => 'required|min:2|max:255|name',
                'description' => 'required|min:15',
            ]);
            if (!$validate['success']) throw new \Exception("Error Processing Request");

            $updateIcon = false;
            if ($_FILES['icon']['size'] > 0) {
                // mengambil nama file cover 
                $iconOld = $this->db->table($this->table)->select('icon')->where([EncKey('id') => Input_('id')])->get()->getRow()->icon;

                // jika cover ada maka hapus filenya
                if ($iconOld != "") {
                    $path = ROOTPATH . 'public/uploads/clients/' . $iconOld;
                    if (file_exists($path)) unlink($path);
                }

                // upload cover baru
                $updateIcon = $this->uploadIcon([EncKey('id') => Input_('id')]);
            }

            if (!Update($this->table, Guard($validate['data'], ['id']), [EncKey('id') => Input_('id')]) && !$updateIcon) throw new \Exception("Tidak ada perubahan");

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

    public function reset_($id)
    {
        try {

            if ($id == '') throw new \Exception("no param");

            if (Update($this->table, ['password' => Enc("123456")], [EncKey('id') => $id]) == false) throw new \Exception("Gagal mereset password");

            $message = [
                'status' => 'ok',
                'message' => 'Berhasil mereset password'
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

    public function set_($id = '')
    {
        try {

            if ($id == '') throw new \Exception("no param");

            $status = $this->req->getPost('status') == "on" ? '1' : '0';

            if (Update($this->table, ['active' => $status], [EncKey('id') => $id]) == false) throw new \Exception("Gagal merubah status");

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

            $iconOld = $this->db->table($this->table)->select('icon')->where([EncKey('id') => $id])->get()->getRow()->icon;
            // jika icon ada maka hapus filenya
            if ($iconOld != "") {
                $path = ROOTPATH . 'public/uploads/clients/' . $iconOld;
                if (file_exists($path)) unlink($path);
            }

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

    public function deleteMultiple()
    {
        try {

            if (!isset($_POST['dataId'])) throw new \Exception("no param");

            $dataId = explode(",", Input_('dataId'));

            $jmlSukses = 0;
            foreach ($dataId as $key) {
                $iconOld = $this->db->table($this->table)->select('icon')->where([EncKey('id') => $key])->get()->getRow()->icon;
                if ($iconOld != "") {
                    $path = ROOTPATH . 'public/uploads/clients/' . $iconOld;
                    if (file_exists($path)) unlink($path);
                }
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
                if (Update($this->table, ['active' => $status], [EncKey('id') => $key])) $jmlSukses++;
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

    private function uploadIcon($idArticle = [])
    {
        try {

            $validated = $this->validate([
                'icon' => [
                    'rules' => 'uploaded[icon]|mime_in[icon,image/jpg,image/jpeg,image/gif,image/png]|max_size[icon,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Format File Harus Berupa jpg, jpeg, gif, png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ]);

            if ($validated == false) throw new \Exception($this->validator->listErrors());
            $file = $this->request->getFile('icon');
            $fileName = time() . "_" . $file->getName();
            $path = ROOTPATH . 'public/uploads/clients/';
            $file->move($path, $fileName);
            $result = Update($this->table, ['icon' => $fileName], $idArticle);
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
