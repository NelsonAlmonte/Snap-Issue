<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InsertStartingPermissions extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name'        => 'report',
                'description' => 'Access to reports.',
            ],
            [
                'name'        => 'user',
                'description' => 'Access to users.',
            ],
            [
                'name'        => 'role',
                'description' => 'Access to roles.',
            ],
            [
                'name'        => 'issue',
                'description' => 'Access to issues.',
            ],
        ];

        foreach ($permissions as $permission) {
            $this->db->table('permissions')->insert($permission);
        }
    }
}
