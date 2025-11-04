<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id'; // Pastikan ini 'id'
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['name', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps = false;

    // Validasi
    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'permit_empty|min_length[8]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email ini sudah digunakan oleh akun lain.'
        ]
    ];
    
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}