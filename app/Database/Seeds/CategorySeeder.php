<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'lingkungan', 'description' => 'Masalah kebersihan, sampah, polusi, dsb'],
            ['name' => 'sosial', 'description' => 'Kegiatan sosial dan kemanusiaan'],
            ['name' => 'hewan', 'description' => 'Hewan liar atau terlantar'],
            ['name' => 'lainnya', 'description' => 'Masalah lain di luar kategori utama'],
        ];
        $this->db->table('categories')->insertBatch($data);
    }
}
