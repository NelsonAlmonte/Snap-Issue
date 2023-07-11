<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIssuesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'category' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'picture' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'latitude' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'longitude' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'completed_date' => [
                'type' => 'date',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('category', 'categories', 'id');
        $this->forge->createTable('issues');
    }

    public function down()
    {
        $this->forge->dropForeignKey('issues', 'issues_category_foreign');
        $this->forge->dropTable('issues');
    }
}
