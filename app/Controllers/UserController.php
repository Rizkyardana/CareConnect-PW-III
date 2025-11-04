<?php

namespace App\Controllers;

use App\Models\ReportModel;

class UserController extends BaseController
{
    protected $reportModel;

    public function __construct()
    {
        $this->reportModel = new ReportModel();
        
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    }

    /**
     * Menampilkan dashboard user
     */
    
    public function dashboard()
{
    $reportModel = new ReportModel();
    
    // Ambil semua laporan dari semua user
    $reports = $reportModel->select('reports.*, users.name as user_name')
                         ->join('users', 'users.id = reports.user_id')
                         ->orderBy('reports.created_at', 'DESC')
                         ->findAll();
    
    // Hitung total laporan per status (semua user)
    $totalMenunggu = $reportModel->where('status', 'menunggu')->countAllResults();
    $totalDiproses = $reportModel->where('status', 'diproses')->countAllResults();
    $totalSelesai = $reportModel->where('status', 'selesai')->countAllResults();
    $totalLaporan = $totalMenunggu + $totalDiproses + $totalSelesai;

    $data = [
        'title' => 'Dashboard',
        'currentRoute' => 'dashboard', // Tambahkan ini
        'reports' => $reports,
        'total_laporan' => $totalLaporan,
        'menunggu' => $totalMenunggu,
        'diproses' => $totalDiproses,
        'selesai' => $totalSelesai,
    ];

    return view('user/dashboard', $data);
}

    /**
     * Menampilkan profil user
     */
    public function profile()
{
    $userId = session()->get('user_id');
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($userId);

    if (!$user) {
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
    }

    $data = [
        'title' => 'Profil Saya',
        'user' => $user,
        'currentRoute' => 'profile'
    ];

    return view('user/profile', $data);
}

// Di UserController.php - method updateProfile
public function updateProfile()
{
    $userId = session()->get('user_id');
    log_message('debug', '=== MULAI UPDATE PROFILE ===');
    log_message('debug', 'User ID dari session: ' . $userId);
    
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($userId);
    
    if (!$user) {
        log_message('error', 'User tidak ditemukan dengan ID: ' . $userId);
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
    }

    // Validasi input
    $rules = [
        'name' => 'required|min_length[3]',
        'email' => [
            'rules' => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'errors' => [
                'is_unique' => 'Email ini sudah digunakan oleh akun lain.'
            ]
        ]
    ];

    if (!$this->validate($rules)) {
        $errors = $this->validator->getErrors();
        log_message('error', 'Validasi gagal: ' . print_r($errors, true));
        return redirect()->back()->withInput()->with('errors', $errors);
    }

    try {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        log_message('debug', 'Data yang akan diupdate: ' . print_r($data, true));

        // Gunakan model untuk update
        if ($userModel->update($userId, $data)) {
            // Update session
            session()->set([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
            
            log_message('debug', '=== UPDATE PROFILE BERHASIL ===');
            return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
        } else {
            log_message('error', 'Gagal update profil. Model mengembalikan false');
            return redirect()->back()->with('error', 'Gagal memperbarui profil')->withInput();
        }
    } catch (\Exception $e) {
        log_message('error', 'Exception: ' . $e->getMessage());
        log_message('error', 'Trace: ' . $e->getTraceAsString());
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}

public function editProfile()
{
    $userId = session()->get('user_id');
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($userId);

    if (!$user) {
        return redirect()->to('/profile')->with('error', 'Pengguna tidak ditemukan');
    }

    $data = [
        'title' => 'Edit Profil',
        'currentRoute' => 'profile',
        'user' => $user
    ];

    return view('user/edit_profile', $data);
}

public function changePassword()
{
    $userId = session()->get('user_id');
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($userId);

    $rules = [
        'current_password' => 'required',
        'new_password' => 'required|min_length[8]',
        'confirm_password' => 'matches[new_password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
        return redirect()->back()->with('error', 'Password saat ini salah');
    }

    $data = [
        'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
    ];

    if ($userModel->update($userId, $data)) {
        return redirect()->to('/profile')->with('success', 'Password berhasil diubah');
    } else {
        return redirect()->back()->with('error', 'Gagal mengubah password');
    }
}
}