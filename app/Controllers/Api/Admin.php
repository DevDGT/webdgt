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

    public function getDataOption($data = '')
    {
        try {
            if ($data == '') throw new \Exception("no param");
            $table = [
                'users' => [
                    'table'     => 'users',
                    'protected' => ['id:hash', 'password', 'token']
                ],
                'tags' => [
                    'table'     => 'tags',
                    'protected' => ['id:hash']
                ],
                'category' => [
                    'table'     => 'category',
                    'protected' => ['id:hash']
                ]
            ];
            if (!array_key_exists($data, $table)) throw new \Exception("nothing there");
            $builder = $this->db->table($table[$data]['table']);
            if (isset($_REQUEST['where'])) $builder->where($_REQUEST['where']);
            if (isset($_REQUEST['order'])) $builder->orderBy(key($_REQUEST['order']), $_REQUEST['order'][key($_REQUEST['order'])]);
            $data_ = $builder->get()->getResultArray();
            $resultData = [];
            foreach ($data_ as $rows) {
                $rows = Guard($rows, $table[$data]['protected']);
                unset($rows['created_at']);
                $resultData[]  = $rows;
            }
            $message = [
                'status' => 'ok',
                'data' => $resultData
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

    public function dataArticle()
    {
        return $this->dataTables([
            'table' => 'article as a',
            'selectData' => "a.id,
                a.title, 
                a.slug, 
                a.cover, 
                u.name as author,
                up.name as update,
                a.created_at,
                a.updated_at,
                a.status,
                (SELECT CONCAT('[', GROUP_CONCAT(CONCAT('\"'," . EncKey('tags.id') . ",':',tags.name,'\"') SEPARATOR ','), ']' ) FROM article_tags atag JOIN tags ON tags.id = atag.tags_id WHERE atag.article_id = a.id) as tags_list,
                cat.name as category
            ",
            'columnOrder"' => [null, 'title', 'u.name', null, 'a.updated_at', null, 'a.status'],
            'columnSearch' => ['a.title', 'a.slug'],
            'join' => [
                'users as u' => 'u.id = a.user_id',
                'users as up' => 'up.id = a.update_by',
                'category as cat'  => 'cat.id = a.category_id',
            ],
            'field' => ['title', 'slug', 'cover', 'author', 'update', 'tags_list', 'category', 'created_at', 'updated_at', 'status']
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

    public function getRowArticle($id)
    {
        return $this->getRowTable([
            'table' => 'article',
            'where' => [EncKey('id') => $id]
        ]);
    }
}
