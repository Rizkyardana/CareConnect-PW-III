<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back button and title -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <div class="flex items-center">
                    <a href="/admin/reports" class="text-gray-500 hover:text-gray-700 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Detail Laporan #<?= $report['id'] ?>
                    </h2>
                </div>
                <p class="mt-1 text-sm text-gray-500">
                    Dikirim oleh <?= esc($report['user_name']) ?> pada 
                    <?= date('d M Y H:i', strtotime($report['created_at'])) ?>
                </p>
            </div>
            <div class="mt-4 flex space-x-2">
                <a href="/admin/reports" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-l-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
                </a>
                <form action="/admin/reports/<?= $report['id'] ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Hapus Laporan
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <?= esc($report['title']) ?>
                    </h3>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                        <?= $report['status'] === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : 
                           ($report['status'] === 'diproses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') ?>">
                        <?= ucfirst($report['status']) ?>
                    </span>
                </div>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Kategori: <span class="font-medium"><?= ucfirst(esc($report['category'])) ?></span>
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Pelapor</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= esc($report['user_name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($report['user_email']) ?></div>
                                </div>
                            </div>
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Lokasi Kejadian</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                            <?= esc($report['location']) ?>
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Kejadian</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <i class="far fa-calendar-alt text-gray-400 mr-1"></i>
                            <?= !empty($report['incident_date']) ? date('d M Y', strtotime($report['incident_date'])) : 'Tidak ditentukan' ?>
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Dibuat pada</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <i class="far fa-clock text-gray-400 mr-1"></i>
                            <?= date('d M Y H:i', strtotime($report['created_at'])) ?>
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">
                            <?= nl2br(esc($report['description'])) ?>
                        </dd>
                    </div>
                    <?php if (!empty($report['photo'])): ?>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Foto Laporan</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <div class="mt-2">
                                <img src="/uploads/<?= esc($report['photo']) ?>" alt="Foto Laporan" class="max-w-full h-auto rounded-lg shadow-sm border border-gray-200">
                            </div>
                        </dd>
                    </div>
                    <?php endif; ?>
                </dl>
            </div>
            <div class="px-4 py-4 bg-gray-50 sm:px-6">
                <div class="flex justify-between items-center">
                    <h4 class="text-sm font-medium text-gray-700">Ubah Status Laporan</h4>
                    <form action="/admin/reports/<?= $report['id'] ?>" method="POST" class="flex items-center space-x-2">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <select name="status" id="status" class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="menunggu" <?= $report['status'] === 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                            <option value="diproses" <?= $report['status'] === 'diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="selesai" <?= $report['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent text-base font-bold rounded-md shadow-sm text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-save mr-2"></i> SIMPAN PERUBAHAN
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Admin Notes Section -->
        <div class="mt-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Catatan Admin
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Tambahkan catatan atau update status laporan
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                    <form action="/admin/reports/<?= $report['id'] ?>/notes" method="POST">
                        <?= csrf_field() ?>
                        <div>
                            <label for="admin_notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                            <div class="mt-1">
                                <textarea id="admin_notes" name="admin_notes" rows="3" class="shadow-sm focus:ring-primary focus:border-primary mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"><?= old('admin_notes', $report['admin_notes'] ?? '') ?></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Berikan catatan atau informasi tambahan tentang laporan ini.
                            </p>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-2.5 border border-transparent text-base font-bold rounded-md shadow-sm text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-save mr-2"></i> SIMPAN CATATAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
