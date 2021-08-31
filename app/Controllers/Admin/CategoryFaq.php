<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class CategoryFaq extends BaseController
{
    public function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = 'category_faq';
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // echo "Asdasd";
        $data = [
            'title' => 'Kategori Faq',
            'menu' => 'master',
            'subMenu' => 'category-faq',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Master' => '',
                'Kategori Produk:active' => '',
            ],
        ];

        return View('admin/category/vCategoryFaq', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'name' => 'required|min:3|name',
            ], [
                'slug' => str_replace(' ', '-', strtolower(Input_('name'))),
            ]);
            $cat = $this->db->table($this->table)->select('slug')->where('slug', str_replace(' ', '-', strtolower(Input_('name'))))->get()->getRow();
            if ($cat) {
                $validate = ValidateAdd($validate, 'name', 'Kategori sudah ada');
            }
            if (!$validate['success']) {
                throw new \Exception('Error Processing Request');
            }
            // Print_($validate['data']);
            if (!Create($this->table, $validate['data'])) {
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
                'name' => 'required|min:3|name',
            ]);
            $cat = $this->db->table($this->table)->select('id, slug')->where('slug', str_replace(' ', '-', strtolower(Input_('name'))))->get()->getRow();
            if ($cat && Enc($cat->id) != Input_('id')) {
                $validate = ValidateAdd($validate, 'name', 'Kategori sudah ada');
            }
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
}
