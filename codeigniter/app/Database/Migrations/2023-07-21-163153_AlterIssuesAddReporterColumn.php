<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterIssuesAddReporterColumn extends Migration
{
    public function up()
    {
        $field = [
            'reporter' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
        ];

        $this->forge->addColumn('issues', $field);
        $this->forge->addForeignKey('reporter', 'users', 'id');
        $this->forge->processIndexes('issues');
    }

    public function down()
    {
        $this->forge->dropForeignKey('users', 'users_reporter_foreign');
        $this->forge->dropColumn('users', 'reporter');
    }
}
