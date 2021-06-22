<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class PublicApi extends BaseController
{
    function __construct()
    {
        // $this->masterModel = new \App\Models\MasterModel();
        $this->db = \Config\Database::connect();
    }

    public function getArticle()
    {
        try {

            $limit = getNewsParam('limit', 0);
            $page = getNewsParam('page', 0);
            $idArticle = getNewsParam('id');
            $slugArticle = getNewsParam('slug');
            $slugCategory = getNewsParam('category');
            $tag = getNewsParam('tags');
            $detail = getNewsParam('detail');

            $this->builder = $this->db->table('article a');
            $this->builder->select('
                    a.id,
                    a.title,
                    a.slug,
                    a.cover,
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
            if ($idArticle != '') $this->builder->where(EncKey('a.id'), $idArticle);
            if ($slugArticle != '') $this->builder->where('a.slug', $slugArticle);
            if ($slugCategory != '') $this->builder->where('c.slug', $slugCategory);
            if ($tag != '') $this->builder->like('a.tags', $tag, 'both');
            $this->builder->where(['status' => '1']);
            $this->builder->limit($limit, ($page != 0 ? $page - 1 : 0) * $limit);
            $article = $this->builder->get()->getResultArray();
            $data = array();
            $field = [
                'title',
                'slug',
                'cover',
                'author',
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
                $row = array();
                $row['id'] = Enc($field_['id']);
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $row['description'] = trim(preg_replace('!\s+!', ' ', (substr(strip_tags($field_['content']), 0, 400) . "...")));
                if ($detail == 'true') $row['content'] = $field_['content'];
                $data[] = $row;
            }

            $result = [
                'status' => 'ok',
                'count' => count($article),
                'data' => $data
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage() . " " . $th->getFile() . " Line : " . $th->getLine()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function getCategory()
    {
        try {

            $this->builder = $this->db->table('category cat');
            $this->builder->select("
                cat.name,
                cat.slug,
                (SELECT COUNT(*) FROM article WHERE category_id = cat.id) count
            ");
            $this->builder->orderBy('count', 'desc');

            $category = $this->builder->get()->getResultArray();

            $result = [
                'status' => 'ok',
                'data' => $category
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($result);
        }
    }

    public function getTags()
    {
        try {
            $this->builder = $this->db->table('article a');
            $this->builder->select("
                a.tags,
            ");
            $tags = $this->builder->get()->getResult();
            $tagsData = [];
            foreach ($tags as $field_) {
                $listTag = explode(" ", $field_->tags);
                foreach ($listTag as $tag) {
                    if (!in_array($tag, $tagsData)) array_push($tagsData, $tag);
                }
            }
            $result = [
                'status' => 'ok',
                'count' => count($tagsData),
                'data' => $tagsData
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($result);
        }
    }

    private function getSocialTeam($userId)
    {
        return $this->db->table('social')->select('social, link')->where('user_id', $userId)->get()->getResultArray();
    }

    public function getTeams()
    {
        try {
            $this->builder = $this->db->table('teams t');
            $this->builder->select("
                u.id,
                u.name,
                u.quotes,
                u.photo,
                j.name jobs
            ");
            $this->builder->join("users u", "u.id = t.user_id");
            $this->builder->join("jobs j", "j.id = t.job_id");
            $this->builder->orderby('j.order', 'asc');
            $this->builder->orderby('u.name', 'asc');
            $this->builder->where('u.active', '1');
            $teams = $this->builder->get()->getResultArray();
            $field = ['name', 'quotes', 'photo', 'jobs'];
            $data = [];
            foreach ($teams as $field_) {
                $row = array();
                foreach ($field as $key) {
                    $row[$key] = $field_[$key];
                }
                $row['socials'] = $this->getSocialTeam($field_['id']);
                $data[] = $row;
            }
            $result = [
                'status' => 'ok',
                'count' => count($data),
                'data' => $data
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            echo json_encode($result);
        }
    }
}
