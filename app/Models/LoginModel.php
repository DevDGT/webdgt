<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";

    public function getLogin($data)
    {
        return $this->db->table($this->table)->where($data)->get();
    }
}
