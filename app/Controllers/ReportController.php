<?php

namespace App\Controllers;

use App\Models\ReportModel;

class ReportController extends BaseController
{

    public function index()
{
    $reportModel = new ReportModel();
    $userId = session()->get('user_id');
    
    // Ambil laporan terbaru dari user yang login (maksimal 5 laporan terbaru)
    $reports = $reportModel->select('reports.*, users.name as user_name')
                         ->join('users', 'users.id = reports.user_id')
                         ->where('reports.user_id', $userId)
                         ->orderBy('reports.created_at', 'DESC')
                         ->findAll(5);
    
    // Hitung total laporan per status untuk user yang login
    $totalMenunggu = $reportModel->where('user_id', $userId)
                               ->where('status', 'menunggu')
                               ->countAllResults();
    $totalDiproses = $reportModel->where('user_id', $userId)
                               ->where('status', 'diproses')
                               ->countAllResults();
    $totalSelesai = $reportModel->where('user_id', $userId)
                              ->where('status', 'selesai')
                              ->countAllResults();
    $totalLaporan = $totalMenunggu + $totalDiproses + $totalSelesai;

    $data = [
        'title' => 'Laporan Saya',
        'currentRoute' => 'reports', // Tambahkan ini
        'reports' => $reports,
        'total_laporan' => $totalLaporan,
        'menunggu' => $totalMenunggu,
        'diproses' => $totalDiproses,
        'selesai' => $totalSelesai,
        'persentase_selesai' => $totalLaporan > 0 ? round(($totalSelesai / $totalLaporan) * 100) : 0,
    ];

    return view('reports/index', $data);
}

    public function create()
    {
        return view('reports/create');
    }

    public function store()
    {
        $reportModel = new ReportModel();

        $photo = $this->request->getFile('photo_before');
        $photoName = null;

        if ($photo && $photo->isValid()) {
            $photoName = $photo->getRandomName();
            $photo->move('uploads', $photoName);
        }

        $data = [
            'user_id'      => session()->get('user_id'),
            'title'        => $this->request->getPost('title'),
            'description'  => $this->request->getPost('description'),
            'category'     => $this->request->getPost('category'),
            'location'     => $this->request->getPost('location'),
            'photo_before' => $photoName,
            'status'       => 'menunggu'
        ];

        $reportModel->save($data);

        return redirect()->to('/reports')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Menampilkan detail laporan
     */
    public function show($id = null)
    {
        $reportModel = new ReportModel();
        $report = $reportModel->getReportWithUser($id);

        if (!$report) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        $data = [
            'report' => $report
        ];

        return view('reports/show', $data);
    }
}
