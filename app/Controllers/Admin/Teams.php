<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Teams extends BaseController
{

    function __construct()
    {
        $this->req = \Config\Services::request();
        $this->table = "teams";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Tim',
            'menu' => 'post',
            'subMenu' => 'teams',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Konten' => '',
                'Tim:active' => '',
            ]
        ];
        return View('admin/teams/vTeams', $data);
    }

    public function store()
    {
        try {
            $validate = Validate([
                'user_id' => 'required',
                'job_id' => 'required',
            ]);
            $userId = $this->db->table("users")->where(EncKey('id'), Input_('user_id'))->get()->getRow()->id;
            $jobId = $this->db->table("jobs")->where(EncKey('id'), Input_('job_id'))->get()->getRow()->id;
            $validate['data']['user_id'] = $userId;
            $validate['data']['job_id'] = $jobId;
            $teams = $this->db->table($this->table)->select('user_id')->where('user_id', $userId)->get()->getRow();
            if ($teams) $validate = ValidateAdd($validate, 'user_id', 'Pengguna sudah ada');
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
                'user_id' => 'required',
                'job_id' => 'required',
            ]);
            $userId = $this->db->table("users")->where(EncKey('id'), Input_('user_id'))->get()->getRow()->id;
            $jobId = $this->db->table("jobs")->where(EncKey('id'), Input_('job_id'))->get()->getRow()->id;
            $validate['data']['user_id'] = $userId;
            $validate['data']['job_id'] = $jobId;
            $teams = $this->db->table($this->table)->select('id, user_id')->where('user_id', $userId)->get()->getRow();
            if ($teams && Enc($teams->id) != Input_('id')) $validate = ValidateAdd($validate, 'user_id', 'Pengguna sudah ada');
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
