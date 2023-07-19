<?php

namespace App\Models;

use CodeIgniter\Model;

class IssueModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function saveIssue($data)
    {
        $this->db
            ->table('issues')
            ->insert($data);
        return $this->db->insertID();
    }

    public function getIssues()
    {
        return $this->db
            ->table('issues i')
            ->select('i.*, c.name AS category_name, c.icon AS category_icon')
            ->join('categories c', 'c.id = i.category')
            ->get()
            ->getResultArray();
    }
}
