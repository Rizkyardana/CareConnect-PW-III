<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUpvotesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'report_id'  => ['type' => 'INT'],
            'user_id'    => ['type' => 'INT'],
            'created_at' => ['type' => 'TIMESTAMP', 'null' => true],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['report_id', 'user_id']);
        $this->forge->addForeignKey('report_id', 'reports', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('upvotes');
    }

    public function down()
    {
        $this->forge->dropTable('upvotes');
    }
}
