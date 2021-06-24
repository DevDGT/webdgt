<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Jobs extends BaseController
{

    function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = "jobs";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Pekerjaan',
            'menu' => 'master',
            'subMenu' => 'jobs',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Master' => '',
                'Pekerjaan:active' => '',
            ]
        ];
        return View('admin/jobs/vjobs', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'name' => 'required|min:3',
                'order' => 'required|number|minNum:1|maxNum:99',
            ]);
            $jobs = $this->db->table($this->table)->select('name')->where('name', Input_('name'))->get()->getRow();
            if ($jobs) $validate = ValidateAdd($validate, 'name', 'Pekerjaan sudah ada');
            if (!$validate['success']) throw new \Exception("Error Processing Request");
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
            $message = array_merge($message, ['validate' => $validate, 'validate' => $validate]);
            echo json_encode($message);
        }
    }

    public function update()
    {
        try {
            $validate = Validate([
                'name' => 'required|min:3',
                'order' => 'required|number|minNum:1|maxNum:99',
            ]);
            $jobs = $this->db->table($this->table)->select('id, name')->where('name', Input_('name'))->get()->getRow();
            if ($jobs && Enc($jobs->id) != Input_('id')) $validate = ValidateAdd($validate, 'name', 'Pekerjaan sudah ada');
            if (!$validate['success']) throw new \Exception("Error Processing Request");
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
}
