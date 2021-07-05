<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ClientsOrders extends BaseController
{

    function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = "clients_orders";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Pesanan Klien',
            'menu' => 'post',
            'subMenu' => 'clients-orders',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Master' => '',
                'Pesanan Klien:active' => '',
            ]
        ];
        return View('admin/clients/vClientsOrders', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'id_clients' => 'required',
                'id_products' => 'required',
            ]);

            $user = $this->db->table($this->table)->where([EncKey('id_clients') => Input_('id_clients'), EncKey('id_products') => Input_('id_products')])->get()->getRow();
            if ($user) $validate = ValidateAdd($validate, 'id_products', 'Produk ada yang sama');
            if (!$validate['success']) throw new \Exception("Error Processing Request");
            $idClients = $this->db->table('clients')->select('id')->where([EncKey('id') => Input_('id_clients')])->get()->getRow()->id;
            $idProducts = $this->db->table('products')->select('id')->where([EncKey('id') => Input_('id_products')])->get()->getRow()->id;
            $validate['data']['id_clients'] = $idClients;
            $validate['data']['id_products'] = $idProducts;
            if (!Create($this->table, $validate['data'])) throw new \Exception("Gagal memasukan data !");
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
                'id_clients' => 'required',
                'id_products' => 'required',
            ]);

            $clients = $this->db->table($this->table)->where([EncKey('id_clients') => Input_('id_clients'), EncKey('id_products') => Input_('id_products')])->get()->getRow();
            if ($clients && Enc($clients->id) != Input_('id')) $validate = ValidateAdd($validate, 'id_products', 'Produk sudah ada');
            if (!$validate['success']) throw new \Exception("Error Processing Request");
            $idClients = $this->db->table('clients')->select('id')->where([EncKey('id') => Input_('id_clients')])->get()->getRow()->id;
            $idProducts = $this->db->table('products')->select('id')->where([EncKey('id') => Input_('id_products')])->get()->getRow()->id;
            $validate['data']['id_clients'] = $idClients;
            $validate['data']['id_products'] = $idProducts;
            if (!Update($this->table, $validate['data'], [EncKey('id') => Input_('id')])) throw new \Exception("Tidak ada perubahan");

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
