<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReportsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'user_id'      => ['type' => 'INT'],
            'title'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'description'  => ['type' => 'TEXT'],
            'category'     => ['type' => 'ENUM', 'constraint' => ['lingkungan', 'sosial', 'hewan', 'lainnya']],
            'location'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'photo_before' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'photo_after'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'       => ['type' => 'ENUM', 'constraint' => ['menunggu', 'diproses', 'selesai'], 'default' => 'menunggu'],
            'upvotes'      => ['type' => 'INT', 'default' => 0],
            'created_at'   => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at' => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reports');
    }

    public function down()
    {
        $this->forge->dropTable('reports');
    }
}
