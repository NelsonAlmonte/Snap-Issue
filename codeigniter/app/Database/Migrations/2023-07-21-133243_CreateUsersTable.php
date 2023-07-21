<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250'
            ],
            'last' => [
                'type'       => 'VARCHAR',
                'constraint' => '250'
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '250'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '250'
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '250'
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '250'
            ],
            'role' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('role', 'roles', 'id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
