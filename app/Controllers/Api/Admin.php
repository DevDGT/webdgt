<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use PharIo\Manifest\Extension;

class Admin extends BaseController
{
    function __construct()
    {
        $this->masterModel = new \App\Models\MasterModel();
        $this->db = \Config\Database::connect();
    }

    public function dataTables($option)
    {
        try {
            $this->masterModel->table = $option['table'] ?? "";
            $this->masterModel->columnOrder = $option['columnOrder'] ?? [];
            $this->masterModel->columnSearch = $option['columnSearch'] ?? [];
            $this->masterModel->selectData = $option['selectData'] ?? "";
            $this->masterModel->tableJoin = $option['join'] ?? [];
            $this->masterModel->order = $option['order'] ?? ['id' => 'desc'];
            $field = $option['field'] ?? [];
            $listData = $this->masterModel->get_datatables();
            // echo $this->db->getLastQuery();
            $data = array();
            foreach ($listData as $field_) {
                $row = array();
                $row['id'] = Enc($field_['id']);
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $data[] = $row;
            }
            $draw = isset($_POST['draw']) ? $_POST['draw'] : null;
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->masterModel->count_all(),
                "recordsFiltered" => $this->masterModel->count_filtered(),
                "data" => $data,
            );
            $message = $output;
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
            echo json_encode($message);
        }
    }

    public function getRowTable($option = ['table' => '', 'where' => []])
    {
        try {

            $data = $this->db->table($option['table'])->where($option['where'])->get()->getRowArray();
            if (!$data) throw new \Exception("no data");
            $data = Guard($data, ["id:hash", "token", "password"]);
            $message = [
                'status' => 'ok',
                'data' => $data
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

    public function dataUsers()
    {
        return $this->dataTables([
            'table' => 'users',
            'selectData' => "id, username, name, email, level, active",
            'field' => ['username', 'name', 'email', 'level', 'active'],
            'columnOrder' => [null, 'username', 'name', 'email', 'level', 'active'],
            'columnSearch' => ['username', 'name', "level", "active"],
            'order' => ['id' => 'desc']
        ]);
    }

    public function dataCategory()
    {
        return $this->dataTables([
            'table' => 'category cat',
            'selectData' => "cat.id, u.name as by, cat.name, cat.slug",
            'field' => ['name', 'by', 'slug'],
            'columnOrder' => [null, 'username', 'name', 'email', 'level', 'active'],
            'columnSearch' => ['username', 'name', "level", "active"],
            'join' => [
                'users u' => 'u.id = cat.user_id'
            ],
            'order' => ['id' => 'desc']
        ]);
    }

    public function dataTags()
    {
        return $this->dataTables([
            'table' => 'tags tag',
            'selectData' => "tag.id, u.name as by, tag.name, tag.slug",
            'field' => ['name', 'by', 'slug'],
            'columnOrder' => [null, 'username', 'name', 'email', 'level', 'active'],
            'columnSearch' => ['username', 'name', "level", "active"],
            'join' => [
                'users u' => 'u.id = tag.user_id'
            ],
            'order' => ['id' => 'desc']
        ]);
    }

    public function getRowUsers($id)
    {
        return $this->getRowTable([
            'table' => 'users',
            'where' => [EncKey('id') => $id]
        ]);
    }

    public function getRowCategory($id)
    {
        return $this->getRowTable([
            'table' => 'category',
            'where' => [EncKey('id') => $id]
        ]);
    }

    public function getRowTags($id)
    {
        return $this->getRowTable([
            'table' => 'tags',
            'where' => [EncKey('id') => $id]
        ]);
    }
}
