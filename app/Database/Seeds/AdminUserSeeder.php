<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Administrator',
            'email'    => 'admin@careconnect.id',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Using query builder to insert data
        $this->db->table('users')->insert($data);

        echo "Admin user created successfully!\n";
        echo "Email: admin@careconnect.id\n";
        echo "Password: admin123\n";
    }
}
