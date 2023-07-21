<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getRolePermissions($role)
    {
        return $this->db
            ->table('permissions')
            ->join('permission_role', 'permission_role.permission = permissions.id')
            ->where('permission_role.role', $role)
            ->get()
            ->getResultArray();
    }
}
