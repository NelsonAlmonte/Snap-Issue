<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getUser($value, $field = 'u.id')
    {
        return $this->db
            ->table('users u')
            ->select('u.*, r.id AS roleId, r.name AS roleName')
            ->join('roles r', 'r.id = u.role')
            ->where($field, $value)
            ->get()
            ->getRowArray();
    }

    public function saveUser($data)
    {
        $this->db
            ->table('users')
            ->insert($data);
        return $this->db->insertID();
    }

    public function updateUser($data)
    {
        return $this->db
            ->table('users')
            ->where('id', $data['id'])
            ->update($data);
    }
}
