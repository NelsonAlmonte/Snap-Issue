<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersAddIsProfileSetupColumn extends Migration
{
    public function up()
    {
        $field = [
            'is_profile_setup' => [
                'type'    => 'BOOLEAN',
                'default' => 0,
            ]
        ];

        $this->forge->addColumn('users', $field);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'is_profile_setup');
    }
}
