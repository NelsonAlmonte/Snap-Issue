<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InsertAdminUser extends Seeder
{
    public function run()
    {
        $user = [
            'username' => 'admin',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'name'     => 'Nelson',
            'last'     => 'Almonte',
            'email'    => 'admin@snapissue.com',
            'image'    => DEFAULT_PROFILE_IMAGE,
            'role'     => 1,
        ];

        $this->db->table('users')->insert($user);
    }
}
