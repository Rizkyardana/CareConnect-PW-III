<?php

namespace App\Controllers;

use App\Models\ReportModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    protected $reportModel;
    protected $userModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->userModel = new UserModel();
        
        // Pastikan hanya admin yang bisa mengakses
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/reports')->with('error', 'Anda tidak memiliki akses ke halaman admin');
        }
    }

    /**
     * Menampilkan dashboard admin
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'total_reports' => $this->reportModel->countAll(),
            'menunggu' => $this->reportModel->where('status', 'menunggu')->countAllResults(),
            'diproses' => $this->reportModel->where('status', 'diproses')->countAllResults(),
            'selesai' => $this->reportModel->where('status', 'selesai')->countAllResults(),
            'recent_reports' => $this->reportModel->select('reports.*, users.name as user_name')
                                                ->join('users', 'users.id = reports.user_id')
                                                ->orderBy('reports.created_at', 'DESC')
                                                ->findAll(5),
            'kategori' => $this->reportModel
                ->select('category, COUNT(*) as total')
                ->groupBy('category')
                ->findAll(),
            'total_users' => $this->userModel->countAll()
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Menampilkan daftar laporan
     */
    public function reports()
    {
        $status = $this->request->getGet('status') ?: 'all';
        $perPage = 5; // Jumlah item per halaman

        // Query menggunakan model dengan join ke tabel users
        $this->reportModel->select('reports.*, users.name as user_name, users.email as user_email')
                         ->join('users', 'users.id = reports.user_id', 'left');
        
        // Hitung total laporan per status (sebelum filter status diaplikasikan)
        $totalReports = $this->reportModel->countAll();
        $menungguCount = $this->reportModel->where('status', 'menunggu')->countAllResults();
        $diprosesCount = $this->reportModel->where('status', 'diproses')->countAllResults();
        $selesaiCount = $this->reportModel->where('status', 'selesai')->countAllResults();
        
        // Reset query builder
        $this->reportModel->resetQuery();
        
        // Query untuk data yang akan ditampilkan
        $this->reportModel->select('reports.*, users.name as user_name, users.email as user_email')
                         ->join('users', 'users.id = reports.user_id', 'left');
        
        // Terapkan filter status jika bukan 'all'
        if ($status !== 'all') {
            $this->reportModel->where('reports.status', $status);
        }
        
        // Urutkan dan paginasi
        $reports = $this->reportModel->orderBy('reports.created_at', 'DESC')
                                   ->paginate($perPage);
        $pager = $this->reportModel->pager;
        
        // Debug: Tampilkan data yang akan dikirim ke view
        log_message('debug', 'Reports Data: ' . print_r($reports, true));
        
        // Debug: Tampilkan data yang akan dikirim ke view
        log_message('debug', 'Reports Data: ' . print_r($reports, true));

        $data = [
            'title' => 'Kelola Laporan',
            'reports' => $reports,
            'pager' => $pager,
            'status' => $status,
            'total_reports' => $totalReports,
            'menunggu_count' => $menungguCount,
            'diproses_count' => $diprosesCount,
            'selesai_count' => $selesaiCount,
            'currentStatus' => $status
        ];

        // Jika request AJAX, kembalikan view partial untuk infinite scroll
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'html' => view('admin/reports/partials/report_items', ['reports' => $data['reports']]),
                'pager' => $data['pager']->links()
            ]);
        }

        return view('admin/reports/index', $data);
    }

    /**
     * Menampilkan detail laporan
     */
    public function showReport($id = null)
    {
        $report = $this->reportModel->select('reports.*, users.name as user_name, users.email as user_email')
                                  ->join('users', 'users.id = reports.user_id')
                                  ->where('reports.id', $id)
                                  ->first();

        if (!$report) {
            return redirect()->to('/admin/reports')->with('error', 'Laporan tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Laporan #' . $id,
            'report' => $report
        ];

        return view('admin/reports/show', $data);
    }

    /**
     * Memperbarui status laporan
     */
    public function updateReport($id = null)
    {
        $report = $this->reportModel->find($id);
        
        if (!$report) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        $status = $this->request->getPost('status');
        
        $this->reportModel->update($id, [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->to('/admin/dashboard')->with('success', 'Status laporan berhasil diperbarui');
    }

    /**
     * Menambahkan catatan admin
     */
    public function addNote($id = null)
    {
        $report = $this->reportModel->find($id);
        
        if (!$report) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        $adminNotes = $this->request->getPost('admin_notes');
        
        $this->reportModel->update($id, [
            'admin_notes' => $adminNotes,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Catatan admin berhasil disimpan');
    }

    /**
     * Menghapus laporan
     */
    public function deleteReport($id = null)
    {
        $report = $this->reportModel->find($id);
        
        if (!$report) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        // Hapus file foto jika ada
        if (!empty($report['photo'])) {
            $filePath = FCPATH . 'uploads/' . $report['photo'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $this->reportModel->delete($id);

        return redirect()->to('/admin/reports')->with('success', 'Laporan berhasil dihapus');
    }
}
