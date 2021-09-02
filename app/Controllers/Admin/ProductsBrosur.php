<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProductsBrosur extends BaseController
{
    public function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = 'products_brosur';
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Produk Brosur',
            'menu' => 'master',
            'subMenu' => 'product-brosur',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Master' => '',
                'Produk Brosur:active' => '',
            ],
        ];

        return View('admin/products/vBrosur', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'title' => 'required|min:2|max:255',
                'product_id' => 'required',
            ]);

            $brosur = $this->db->table($this->table)->where('title', Input_('title'))->get()->getRow();
            if ($brosur) {
                $validate = ValidateAdd($validate, 'title', 'judul ada yang sama');
            }
            if (!$validate['success']) {
                throw new \Exception('Error Processing Request');
            }
            $productId = $this->db->table('products')->select('id')->where([EncKey('id') => Input_('product_id')])->get()->getRow()->id;
            $validate['data']['product_id'] = $productId ?? 0;
            $insertBrosur = Create($this->table, $validate['data']);
            $idBrosur = $this->db->insertID();
            $uploadBrosur = $this->uploadBrosur(['id' => $idBrosur]);
            if (!$insertBrosur && !$uploadBrosur) {
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
            $message = array_merge($message, ['validate' => $validate]);
            echo json_encode($message);
        }
    }

    public function update()
    {
        try {
            $validate = Validate([
                'title' => 'required|min:2|max:255',
                'product_id' => 'required',
            ]);
            if (!$validate['success']) {
                throw new \Exception('Error Processing Request');
            }
            $categoryId = $this->db->table('products')->select('id')->where([EncKey('id') => Input_('product_id')])->get()->getRow()->id;
            $validate['data']['product_id'] = $categoryId ?? 0;
            $updateIcon = false;
            if ($_FILES['brosur']['size'] > 0) {
                // mengambil nama file brosur
                $brosurOld = $this->db->table($this->table)->select('file')->where([EncKey('id') => Input_('id')])->get()->getRow()->file;

                // jika brosur ada maka hapus filenya
                if ($brosurOld != "") {
                    $path = FILESDIR . '/uploads/products/brosur/' . $brosurOld;
                    if (file_exists($path)) unlink($path);
                }

                // upload brosur baru
                $updateIcon = $this->uploadBrosur([EncKey('id') => Input_('id')]);
            }

            if (!Update($this->table, Guard($validate['data'], ['id']), [EncKey('id') => Input_('id')]) && !$updateIcon) {
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

    public function delete()
    {
        try {
            if (!isset($_POST['id'])) {
                throw new \Exception('no param');
            }
            $id = Input_('id');

            $brosurOld = $this->db->table($this->table)->select('file')->where([EncKey('id') => $id])->get()->getRow()->file;
            // jika icon ada maka hapus filenya
            if ($brosurOld != '') {
                $path = FILESDIR . '/uploads/products/brosur/' . $brosurOld;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

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
                $brosurOld = $this->db->table($this->table)->select('file')->where([EncKey('id') => $key])->get()->getRow()->file;
                if ($brosurOld != '') {
                    $path = FILESDIR . '/uploads/products/brosur/' . $brosurOld;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                if (Delete($this->table, [EncKey('id') => $key])) {
                    ++$jmlSukses;
                }
            }

            $message = [
                'status' => 'ok',
                'message' => "Berhasil menghapus <b>$jmlSukses</b> data dari <b>" . count($dataId) . '</b> data',
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
                'message' => "Berhasil merubah status <b>$jmlSukses</b> data dari <b>" . count($dataId) . '</b> data',
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

    private function uploadBrosur($idProduct = [])
    {
        try {
            $validated = $this->validate([
                'brosur' => [
                    'rules' => 'uploaded[brosur]|mime_in[brosur,application/pdf]|max_size[brosur,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Format File Harus Berupa jpg, jpeg, gif, png',
                        'max_size' => 'Ukuran File Maksimal 2 MB',
                    ],
                ],
            ]);

            if ($validated == false) {
                throw new \Exception($this->validator->listErrors());
            }
            $file = $this->request->getFile('brosur');
            $fileName = time() . "_" . $file->getName();
            $path = FILESDIR . '/uploads/products/brosur/';
            $file->move($path, $fileName);
            $result = Update($this->table, ['file' => $fileName], $idProduct);
        } catch (\Throwable $th) {
            $result = [
                'uploaded' => 0,
                'error' => ['message' => preg_replace('!\s+!', ' ', strip_tags($th->getMessage()))],
            ];
        } catch (\Exception $ex) {
            $result = [
                'uploaded' => 0,
                'error' => ['message' => preg_replace('!\s+!', ' ', strip_tags($ex->getMessage()))],
            ];
        } finally {
            return $result;
        }
    }
}
