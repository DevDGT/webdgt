<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class PublicApi extends BaseController
{
    public function __construct()
    {
        // $this->masterModel = new \App\Models\MasterModel();
        $this->db = \Config\Database::connect();
    }

    public function getArticle()
    {
        try {
            $limit = getUrlParam('limit', 0);
            $page = getUrlParam('page', 0);
            $idArticle = getUrlParam('id');
            $slugArticle = getUrlParam('slug');
            $slugCategory = getUrlParam('category');
            $tag = getUrlParam('tags');
            $detail = getUrlParam('detail');
            //$cari = getUrlParam('q');

            $this->builder = $this->db->table('article a');
            $this->builder->select('
                    a.id,
                    a.title,
                    a.slug,
                    a.cover,
                    u.id userId,
                    u.username,
                    u.name author,
                    u.photo author_photo,
                    u.quotes,
                    up.name updated_by,
                    c.slug category_slug,
                    c.name category,
                    a.tags,
                    a.content,
                    a.created_at,
                    a.updated_at
                ');
            $this->builder->join('users u', 'u.id = a.user_id');
            $this->builder->join('category c', 'c.id = a.category_id');
            $this->builder->join('users up', 'up.id = a.update_by');
            $this->builder->orderBy('id', 'desc');
            if ($idArticle != '') {
                $this->builder->where(EncKey('a.id'), $idArticle);
            }
            if ($slugArticle != '') {
                $this->builder->where('a.slug', $slugArticle);
            }
            if ($slugCategory != '') {
                $this->builder->where('c.slug', $slugCategory);
            }
            if ($tag != '') {
                $this->builder->like('a.tags', $tag, 'both');
            }
            // if ($cari != '') {
            //     $this->builder->where('a.slug', $slugArticle);
            // }
            $this->builder->where(['status' => '1']);
            $this->builder->limit($limit, ($page != 0 ? $page - 1 : 0) * $limit);
            $article = $this->builder->get()->getResultArray();
            $data = [];
            $field = [
                'title',
                'slug',
                'cover',
                'author',
                'username',
                'author_photo',
                'quotes',
                'updated_by',
                'category_slug',
                'category',
                'tags',
                'created_at',
                'updated_at',
            ];
            foreach ($article as $field_) {
                $row = [];
                $row['id'] = Enc($field_['id']);
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $row['description'] = trim(preg_replace('!\s+!', ' ', (substr(strip_tags($field_['content']), 0, 400).'...')));
                if ($detail == 'true') {
                    $row['content'] = $field_['content'];
                }
                $row['socials'] = $this->getSocialTeam($field_['userId']);
                $data[] = $row;
            }

            $result = [
                'status' => 'ok',
                'count' => count($article),
                'data' => $data,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().' '.$th->getFile().' Line : '.$th->getLine(),
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

    public function getCategory()
    {
        try {
            $category = $this->db->query("SELECT `cat`.`name`, `cat`.`slug`, (SELECT COUNT(*) FROM article WHERE category_id = cat.id AND status = '1') count FROM `category` `cat` WHERE (SELECT COUNT(*) FROM article WHERE category_id = cat.id AND status = '1') != '0' ORDER BY `count` DESC")->getResult();

            $result = [
                'status' => 'ok',
                'data' => $category,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().$this->db->getLastQuery(),
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

    public function getCategoryProducts()
    {
        try {
            $category = $this->db->query('SELECT '.EncKey('cat.id')." id , `cat`.`name`, `cat`.`slug`, (SELECT COUNT(*) FROM products WHERE id_category_product = cat.id AND active = '1') count FROM `category_product` `cat` WHERE (SELECT COUNT(*) FROM products WHERE id_category_product = cat.id AND active = '1') != '0' ORDER BY `count` DESC")->getResult();

            $result = [
                'status' => 'ok',
                'data' => $category,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().$this->db->getLastQuery(),
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

    public function getCategoryFaq()
    {
        try {
            $category = $this->db->query('SELECT '.EncKey('cat.id')." id , `cat`.`name`, `cat`.`slug`, (SELECT COUNT(*) FROM faq WHERE id_category = cat.id AND active = '1') count FROM `category_faq` `cat` WHERE (SELECT COUNT(*) FROM faq WHERE id_category = cat.id AND active = '1') != '0' ORDER BY `count` DESC")->getResult();

            $result = [
                'status' => 'ok',
                'data' => $category,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().$this->db->getLastQuery(),
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

    public function getTags()
    {
        try {
            $this->builder = $this->db->table('article a');
            $this->builder->select('
                a.tags,
            ');
            $this->builder->where('status', '1');
            $tags = $this->builder->get()->getResult();
            $tagsData = [];
            foreach ($tags as $field_) {
                $listTag = explode(' ', $field_->tags);
                foreach ($listTag as $tag) {
                    if (!in_array($tag, $tagsData)) {
                        array_push($tagsData, $tag);
                    }
                }
            }
            $result = [
                'status' => 'ok',
                'count' => count($tagsData),
                'data' => $tagsData,
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

    private function getSocialTeam($userId)
    {
        return $this->db->table('social')->select('social, link')->where('user_id', $userId)->get()->getResultArray();
    }

    private function getClientProducts($productId)
    {
        return $this->db->table('clients_orders co')
            ->select(EncKey('c.id').' id, c.name')
            ->join('clients c', 'c.id = co.id_clients')
            ->where('co.id_products', $productId)
            ->get()->getResultArray();
    }

    public function teamsPage()
    {
        try {
            $id = getUrlParam('id');
            $username = getUrlParam('username');

            $this->builder = $this->db->table('web');
            $this->builder->select('html, css, js');
            if ($id != '') {
                $this->builder->where(EncKey('user_id'), $id);
            }
            if ($username != '') {
                $this->builder->join('users u', 'u.id = web.user_id', 'left');
                $this->builder->where('username', $username);
            }

            $data = $this->builder->get()->getRowArray();

            if (!$data) {
                throw new \Exception('data tidak ditemukan');
            }
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

    public function getTeams()
    {
        try {
            $this->builder = $this->db->table('teams t');
            $this->builder->select('
                u.id,
                u.username,
                u.name,
                u.quotes,
                u.photo,
                j.name jobs
            ');
            $this->builder->join('users u', 'u.id = t.user_id');
            $this->builder->join('jobs j', 'j.id = t.job_id');
            $this->builder->orderby('j.order', 'asc');
            $this->builder->orderby('u.name', 'asc');
            $this->builder->where('u.active', '1');
            $teams = $this->builder->get()->getResultArray();
            $field = ['username', 'name', 'quotes', 'photo', 'jobs'];
            $data = [];
            foreach ($teams as $field_) {
                $row = [];
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $row['socials'] = $this->getSocialTeam($field_['id']);
                $data[] = $row;
            }
            $result = [
                'status' => 'ok',
                'count' => count($data),
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

    public function getClients()
    {
        try {
            $clients = $this->db->table('clients')
                ->select(EncKey('id').'id ,name, icon, description')
                ->where('active', '1')
                ->orderby('id', 'desc')->get()->getResult();
            $result = [
                'status' => 'ok',
                'count' => count($clients),
                'data' => $clients,
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

    public function getClientsOrders($idProduct)
    {
        try {
            $clients = $this->db->table('clients_orders co')
                ->select(EncKey('co.id').'id, c.name,c.icon, c.description, co.jobs')
                ->where('co.active', '1')
                ->where(EncKey('co.id_products'), $idProduct)
                ->join('clients c', 'c.id = co.id_clients')
                ->orderby('id', 'desc')->get()->getResult();
            $result = [
                'status' => 'ok',
                'count' => count($clients),
                'data' => $clients,
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

    public function getClientsSelect($idClient)
    {
        try {
            $clients = $this->db->table('clients_orders co')
                ->select(EncKey('co.id').'id, p.name, p.icon, co.date')
                ->where('co.active', '1')
                ->where(EncKey('co.id_clients'), $idClient)
                ->join('products p', 'p.id = co.id_products')
                ->orderby('id', 'desc')->get()->getResult();
            $result = [
                'status' => 'ok',
                'count' => count($clients),
                'data' => $clients,
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

    public function getCareer($idCareer = '')
    {
        try {
            $idCareer = getUrlParam('id');
            $slugCareer = getUrlParam('slug');

            $this->builder = $this->db->table('career');
            $this->builder->select('id, '.EncKey('id_category_career').' id_category_career, slug, name, icon, description');
            $this->builder->where('active', '1');
            if ($idCareer != '') {
                $this->builder->where(EncKey('id'), $idCareer);
            }
            if ($slugCareer != '') {
                $this->builder->where('slug', $slugCareer);
            }
            $clients = $this->builder->orderby('id', 'desc')->get()->getResultArray();

            $field = ['name', 'id_category_career', 'slug', 'icon', 'description'];
            $data = [];
            foreach ($clients as $field_) {
                $row = [];
                $row['id'] = Enc($field_['id']);
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $data[] = $row;
            }
            $result = [
                'status' => 'ok',
                'count' => count($clients),
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

    public function getProducts($idProducts = '')
    {
        try {
            $idProducts = getUrlParam('id');
            $slugProducts = getUrlParam('slug');

            $this->builder = $this->db->table('products');
            $this->builder->select('id, '.EncKey('id_category_product').' id_category_product, slug, name, icon, video, description');
            $this->builder->where('active', '1');
            if ($idProducts != '') {
                $this->builder->where(EncKey('id'), $idProducts);
            }
            if ($slugProducts != '') {
                $this->builder->where('slug', $slugProducts);
            }
            $clients = $this->builder->orderby('id', 'desc')->get()->getResultArray();

            $field = ['name', 'id_category_product', 'slug', 'icon', 'video', 'description'];
            $data = [];
            foreach ($clients as $field_) {
                $row = [];
                $row['id'] = Enc($field_['id']);
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $row['client'] = $this->getClientProducts($field_['id']);
                $data[] = $row;
            }
            $result = [
                'status' => 'ok',
                'count' => count($clients),
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

    public function getProductsDemo($idProducts = '')
    {
        try {
            $idProducts = getUrlParam('id');
            $this->builder = $this->db->table('products_demo');
            $this->builder->select(EncKey('id').'id ,title, link');
            $this->builder->where('active', '1');
            $this->builder->where(EncKey('product_id'), $idProducts);
            $demo = $this->builder->orderby('id', 'desc')->get()->getResult();
            $result = [
                'status' => 'ok',
                'count' => count($demo),
                'data' => $demo,
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

    public function getProductsBrosur($idProducts = '')
    {
        try {
            // $idProducts = getUrlParam('id');
            $this->builder = $this->db->table('products_brosur p');
            $this->builder->select(EncKey('p.id').' id ,p.title, p.file');
            $this->builder->where(EncKey('p.product_id'), $idProducts);
            $this->builder->where('active', '1');
            $demo = $this->builder->orderby('id', 'desc')->get()->getResult();
            $result = [
                'status' => 'ok',
                'count' => count($demo),
                'data' => $demo,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().$this->db->getLastQuery(),
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

    public function getProductsFile($idFile = '')
    {
        try {
            // $idProducts = getUrlParam('id');
            $this->builder = $this->db->table('products_brosur p');
            $this->builder->select('p.file , p.title');
            $this->builder->where(EncKey('p.id'), $idFile);
            $this->builder->where('active', '1');
            $demo = $this->builder->orderby('p.file', 'desc')->get()->getResult();
            $result = [
                'status' => 'ok',
                'count' => count($demo),
                'data' => $demo,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().$this->db->getLastQuery(),
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

    public function getFaq($category = '')
    {
        try {
            $slug = getUrlParam('slug');
            $this->builder = $this->db->table('faq');
            $this->builder->select(EncKey('faq.id').'id ,question, answers, cat.slug category, faq.slug');
            $this->builder->join('category_faq cat', 'cat.id = faq.id_category');
            $this->builder->where('active', '1');
            if ($category !== '') {
                $this->builder->where('cat.slug', $category);
            }
            if ($slug !== '') {
                $this->builder->where('faq.slug', $slug);
            }
            $faq = $this->builder->orderby('faq.id', 'desc')->get()->getResultArray();
            $field = ['question', 'slug', 'category'];

            $data = [];
            foreach ($faq as $field_) {
                $row = [];
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $row['answers'] = $slug == '' ? substr(strip_tags($field_['answers']), 0, 200) : $field_['answers'];
                $data[] = $row;
            }
            $result = [
                'status' => 'ok',
                'count' => count($faq),
                'data' => $data,
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage().$th->getLine(),
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
}
