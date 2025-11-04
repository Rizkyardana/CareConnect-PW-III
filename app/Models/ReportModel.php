<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'title', 'description', 'category', 'location',
        'photo_before', 'photo_after', 'status', 'upvotes',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

    public function getReportsWithUser()
    {
        return $this->select('reports.*, users.name AS user_name')
                    ->join('users', 'users.id = reports.user_id')
                    ->orderBy('reports.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Mengambil satu laporan beserta data pengirimnya
     */
    public function getReportWithUser($id)
    {
        return $this->select('reports.*, users.name AS user_name, users.email AS user_email')
                    ->join('users', 'users.id = reports.user_id')
                    ->where('reports.id', $id)
                    ->first();
    }
}
