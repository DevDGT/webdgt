<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->req = \Config\Services::request();
        $this->masterModel = new \App\Models\MasterModel();
        $this->db = \Config\Database::connect();
    }

    private function dataTables($option)
    {
        try {
            $this->masterModel->table = $option['table'] ?? '';
            $this->masterModel->columnOrder = $option['columnOrder'] ?? [];
            $this->masterModel->columnSearch = $option['columnSearch'] ?? [];
            $this->masterModel->selectData = $option['selectData'] ?? '';
            $this->masterModel->tableJoin = $option['join'] ?? [];
            $this->masterModel->order = $option['order'] ?? ['id' => 'desc'];
            $this->masterModel->whereData = $option['whereData'] ?? [];
            $field = $option['field'] ?? [];
            $listData = $this->masterModel->get_datatables();
            // echo $this->db->getLastQuery();
            $data = [];
            foreach ($listData as $field_) {
                $row = [];
                $row['id'] = Enc($field_['id']);
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $data[] = $row;
            }
            $draw = isset($_POST['draw']) ? $_POST['draw'] : null;
            $output = [
                'draw' => $draw,
                'recordsTotal' => $this->masterModel->count_all(),
                'recordsFiltered' => $this->masterModel->count_filtered(),
                'data' => $data,
            ];
            $result = $output;
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().', Line : '.$th->getLine().', File : '.$th->getFile().', Query : '.$this->db->getLastQuery(),
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage(),
            ];
        } finally {
            echo json_encode($result);
        }
    }

    private function getRowTable($option = ['table' => '', 'select' => '', 'where' => [], 'guard' => []])
    {
        try {
            $data = $this->db->table($option['table'])->select(isset($option['select']) ? $option['select'] : '*')->where($option['where'])->get()->getRowArray();
            if (!$data) {
                throw new \Exception('no data');
            }
            $guard = ['id:hash', 'token', 'password'];
            if (!empty($option['guard'])) {
                $guard = array_merge($guard, $option['guard']);
            }
            $data = Guard($data, $guard);
            $result = [
                'status' => 'ok',
                'data' => $data,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage(),
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage(),
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function getDataOption($data = '')
    {
        try {
            if ($data == '') {
                throw new \Exception('no param');
            }
            $table = [
                'users' => [
                    'table' => 'users',
                    'protected' => ['id:hash', 'password', 'token'],
                ],
                'jobs' => [
                    'table' => 'jobs',
                    'protected' => ['id:hash'],
                ],
                'category' => [
                    'table' => 'category',
                    'protected' => ['id:hash'],
                ],
                'category-product' => [
                    'table' => 'category_product',
                    'protected' => ['id:hash'],
                ],
                'category-faq' => [
                    'table' => 'category_faq',
                    'protected' => ['id:hash'],
                ],
                'clients' => [
                    'table' => 'clients',
                    'protected' => ['id:hash'],
                ],
                'products' => [
                    'table' => 'products',
                    'protected' => ['id:hash'],
                ],
                'career' => [
                    'table' => 'career',
                    'protected' => ['id:hash'],
                ],
                'category-career' => [
                    'table' => 'category_career',
                    'protected' => ['id:hash'],
                ],
            ];
            if (!array_key_exists($data, $table)) {
                throw new \Exception('nothing there');
            }
            $builder = $this->db->table($table[$data]['table']);
            if (isset($_REQUEST['where'])) {
                $builder->where($_REQUEST['where']);
            }
            if (isset($_REQUEST['order'])) {
                $builder->orderBy(key($_REQUEST['order']), $_REQUEST['order'][key($_REQUEST['order'])]);
            }
            $data_ = $builder->get()->getResultArray();
            $resultData = [];
            foreach ($data_ as $rows) {
                $rows = Guard($rows, $table[$data]['protected']);
                unset($rows['created_at']);
                $resultData[] = $rows;
            }
            $result = [
                'status' => 'ok',
                'data' => $resultData,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage(),
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage(),
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function setUserStatus()
    {
        try {
            $this->db = \Config\Database::connect();
            $postToken = $this->req->getPost('token');
            $userId = $this->req->getPost('userId');
            $status = $this->req->getPost('status');
            if (!$postToken) {
                throw new \Exception('no access token');
            }
            $user = $this->db->table('users')->select('username, token')->where('token', $postToken)->get()->getRow();
            if ($postToken != $user->token) {
                throw new \Exception('token invalid');
            }
            if (!$userId) {
                throw new \Exception('no user id');
            }
            if (!$status && !$status == 0) {
                throw new \Exception('no status');
            }
            if (!intval($status) && !$status == 0) {
                throw new \Exception('invalid status code');
            }
            if (intval($status) < 0 || intval($status) > 1) {
                throw new \Exception('invalid status code only 1 or 0');
            }
            if (!Update('users', ['online' => $status], [EncKey('id') => $userId])) {
                throw new \Exception('Gagal merubah status !');
            }
            // if ($status == 0) Update('users', ['token' => ""], [EncKey('id') => $userId]);

            $result = [
                'status' => 'ok',
                'message' => $status == 1 ? 'User Online '.$user->username : 'User Offline '.$user->username,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage(),
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage(),
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function userSocials()
    {
        return $this->dataTables([
            'table' => 'social s',
            'selectData' => 'id, social, link',
            'field' => ['social', 'link'],
            'columnOrder' => [null, 'social', 'link'],
            'columnSearch' => ['social', 'link'],
            'whereData' => [
                'user_id' => session('userId'),
            ],
            'order' => ['social' => 'asc'],
        ]);
    }

    public function dataUsers()
    {
        return $this->dataTables([
            'table' => 'users',
            'selectData' => 'id, username, name, email, level, active',
            'field' => ['username', 'name', 'email', 'level', 'active'],
            'columnOrder' => [null, 'username', 'name', 'email', 'level', 'active'],
            'columnSearch' => ['username', 'name', 'level', 'active'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataCategory()
    {
        return $this->dataTables([
            'table' => 'category cat',
            'selectData' => 'cat.id, u.name as by, cat.name, cat.slug',
            'field' => ['name', 'by', 'slug'],
            'columnOrder' => [null, 'name', 'slug'],
            'columnSearch' => ['cat.name', 'cat.slug'],
            'join' => [
                'users u' => 'u.id = cat.user_id',
            ],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataCategoryProduct()
    {
        return $this->dataTables([
            'table' => 'category_product cat',
            'selectData' => 'cat.id, cat.name, cat.slug',
            'field' => ['name', 'slug'],
            'columnOrder' => [null, 'name', 'slug'],
            'columnSearch' => ['cat.name', 'cat.slug'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataCategoryFaq()
    {
        return $this->dataTables([
            'table' => 'category_faq cat',
            'selectData' => 'cat.id, cat.name, cat.slug',
            'field' => ['name', 'slug'],
            'columnOrder' => [null, 'name', 'slug'],
            'columnSearch' => ['cat.name', 'cat.slug'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataCategoryCareer()
    {
        return $this->dataTables([
            'table' => 'category_career cat',
            'selectData' => 'cat.id, cat.name, cat.slug',
            'field' => ['name', 'slug'],
            'columnOrder' => [null, 'name', 'slug'],
            'columnSearch' => ['cat.name', 'cat.slug'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataClients()
    {
        return $this->dataTables([
            'table' => 'clients c',
            'selectData' => 'c.id, c.name, c.icon, c.description, c.active',
            'field' => ['name', 'icon', 'description', 'active'],
            'columnOrder' => [null, 'name', 'description', 'active'],
            'columnSearch' => ['c.name', 'c.description'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataClientsOrders()
    {
        return $this->dataTables([
            'table' => 'clients_orders co',
            'selectData' => 'co.id,c.name clientName,p.icon,p.name productName,co.active',
            'field' => ['clientName', 'icon', 'productName', 'active'],
            'columnOrder' => [null, 'c.name', 'p.name', 'active'],
            'columnSearch' => ['c.name', 'p.name', 'p.description'],
            'join' => [
                'clients c' => 'c.id = co.id_clients',
                'products p' => 'p.id = co.id_products',
            ],
            'order' => ['co.id' => 'desc'],
        ]);
    }

    public function dataCareer()
    {
        return $this->dataTables([
            'table' => 'career c',
            'selectData' => 'c.id, c.name, c.slug, c.icon, c.description, c.active',
            'field' => ['name', 'slug', 'icon', 'description', 'active'],
            'columnOrder' => [null, 'name', 'description', 'active'],
            'columnSearch' => ['c.name', 'c.description'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataProducts()
    {
        return $this->dataTables([
            'table' => 'products p',
            'selectData' => 'p.id, p.name, p.slug, p.icon, p.description, p.active',
            'field' => ['name', 'slug', 'icon', 'description', 'active'],
            'columnOrder' => [null, 'name', 'description', 'active'],
            'columnSearch' => ['p.name', 'p.description'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataProductsDemo()
    {
        return $this->dataTables([
            'table' => 'products_demo pd',
            'selectData' => 'pd.id, pd.title, pd.link, pd.active',
            'field' => ['title', 'link', 'active'],
            'columnOrder' => [null, 'title', 'active'],
            'columnSearch' => ['pd.title', 'pd.link'],
            'whereData' => [
                EncKey('product_id') => $this->req->getPost('idProduct'),
            ],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataProductsBrosur()
    {
        return $this->dataTables([
            'table' => 'products_brosur pb',
            'selectData' => 'pb.id, pb.title, pb.file, pb.active',
            'field' => ['title', 'file', 'active'],
            'columnOrder' => [null, 'title', 'active'],
            'columnSearch' => ['pb.title', 'pb.file'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataJobs()
    {
        return $this->dataTables([
            'table' => 'jobs j',
            'selectData' => 'name, order, id',
            'field' => ['name', 'order'],
            'columnOrder' => [null, 'name', 'order'],
            'columnSearch' => ['name'],
            'order' => ['order' => 'asc'],
        ]);
    }

    public function dataTeams()
    {
        return $this->dataTables([
            'table' => 'teams t',
            'selectData' => 't.id, u.username, u.name, u.quotes, u.email, u.photo, j.name jobs, j.order',
            'field' => ['name', 'quotes', 'email', 'photo', 'jobs', 'order'],
            'columnOrder' => [null, 'name', 'order'],
            'columnSearch' => ['u.name', 'u.quotes', 'u.email', 'j.name', 'u.username'],
            'join' => [
                'users u' => 'u.id = t.user_id',
                'jobs j' => 'j.id = t.job_id',
            ],
            'whereData' => ['u.active' => '1'],
            'order' => ['j.order' => 'asc'],
        ]);
    }

    public function dataFaq()
    {
        return $this->dataTables([
            'table' => 'faq',
            'selectData' => 'id, question, answers, active',
            'field' => ['question', 'answers', 'active'],
            'columnOrder' => [null, 'question', 'answers', 'active'],
            'columnSearch' => ['question', 'answer'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataImel()
    {
        return $this->dataTables([
            'table' => 'imel',
            'selectData' => 'id, name, subject, emails, message',
            'field' => ['name', 'subject', 'emails', 'message'],
            'columnOrder' => [null, 'name', 'subject', 'emails', 'message'],
            'columnSearch' => ['name', 'subject', 'emails'],
            'order' => ['id' => 'desc'],
        ]);
    }

    public function dataArticle()
    {
        // $userFilter = session('level') != "1" ? ['a.user_id' => session('userId')] : '';
        return $this->dataTables([
            'table' => 'article as a',
            'selectData' => 'a.id,
                a.title, 
                a.slug, 
                a.cover, 
                u.name as author,
                u.username,
                up.name as update,
                a.created_at,
                a.updated_at,
                a.status,
                a.tags,
                cat.name as category
            ',
            'columnOrder' => [null, 'a.title', 'u.name', null, 'a.updated_at', null, 'a.status'],
            'columnSearch' => ['a.title', 'a.slug'],
            'join' => [
                'users as u' => 'u.id = a.user_id',
                'users as up' => 'up.id = a.update_by',
                'category as cat' => 'cat.id = a.category_id',
            ],
            // 'whereData' => $userFilter,
            'field' => ['title', 'slug', 'cover', 'username', 'author', 'update', 'tags', 'category', 'created_at', 'updated_at', 'status'],
        ]);
    }

    public function dataProfile()
    {
        try {
            $user = $this->db->table('users')->select('*')->where('id', session('userId'))->get()->getRowArray();

            if (!$user) {
                throw new \Exception('User Not Found !');
            }
            $result = [
                'status' => 'ok',
                'data' => Guard($user, ['id:hash', 'password']),
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage(),
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'ok',
                'message' => $ex->getMessage(),
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function getRowUsers($id)
    {
        return $this->getRowTable([
            'table' => 'users',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowCategory($id)
    {
        return $this->getRowTable([
            'table' => 'category',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowCategoryProduct($id)
    {
        return $this->getRowTable([
            'table' => 'category_product',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowCategoryFaq($id)
    {
        return $this->getRowTable([
            'table' => 'category_faq',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowJobs($id)
    {
        return $this->getRowTable([
            'table' => 'jobs',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowTeams($id)
    {
        return $this->getRowTable([
            'table' => 'teams',
            'where' => [EncKey('id') => $id],
            'guard' => [
                'user_id:hash',
                'job_id:hash',
            ],
        ]);
    }

    public function getRowArticle($id)
    {
        return $this->getRowTable([
            'table' => 'article',
            'where' => [EncKey('id') => $id],
            'guard' => ['category_id:hash'],
        ]);
    }

    public function getRowClients($id)
    {
        return $this->getRowTable([
            'table' => 'clients',
            'select' => 'id, name, icon, description',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowCareer($id)
    {
        return $this->getRowTable([
            'table' => 'career',
            'select' => 'id, name, icon, description, id_category_career',
            'where' => [EncKey('id') => $id],
            'guard' => ['id_category_career:hash'],
        ]);
    }

    public function getRowProducts($id)
    {
        return $this->getRowTable([
            'table' => 'products',
            'select' => 'id, name, icon, description, id_category_product, video',
            'where' => [EncKey('id') => $id],
            'guard' => ['id_category_product:hash'],
        ]);
    }

    public function getRowProductsBrosur($id)
    {
        return $this->getRowTable([
            'table' => 'products_brosur',
            'select' => 'id, title, file, product_id',
            'where' => [EncKey('id') => $id],
            'guard' => ['product_id:hash'],
        ]);
    }

    public function getRowProductsDemo($id)
    {
        return $this->getRowTable([
            'table' => 'products_demo',
            'select' => 'id, title, link',
            'where' => [EncKey('id') => $id],
        ]);
    }

    public function getRowClientsOrders($id)
    {
        return $this->getRowTable([
            'table' => 'clients_orders',
            'select' => 'id, id_products, id_clients, date, jobs',
            'where' => [EncKey('id') => $id],
            'guard' => ['id_clients:hash', 'id_products:hash'],
        ]);
    }

    public function getRowProfileSocial($id)
    {
        return $this->getRowTable([
            'table' => 'social',
            'select' => 'id, user_id, social, link',
            'where' => [EncKey('id') => $id],
            'guard' => ['user_id:hash'],
        ]);
    }

    public function getRowFaq($id)
    {
        return $this->getRowTable([
            'table' => 'faq',
            'select' => 'id, question, answers, id_category',
            'where' => [EncKey('id') => $id],
            'guard' => ['id_category:hash'],
        ]);
    }

    public function getYears()
    {
        try {
            for ($i = 2007; $i < intval(date('Y')); ++$i) {
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage,
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage,
            ];
        } finally {
            echo json_encode($result);
        }
    }
}
