<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="/reports" class="inline-flex items-center text-primary hover:text-blue-600">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
            </a>
        </div>

        <!-- Card Laporan -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900"><?= esc($report['title']) ?></h1>
                        <div class="mt-1 flex flex-wrap items-center text-sm text-gray-500">
                            <span class="flex items-center">
                                <i class="fas fa-user mr-1"></i> <?= esc($report['user_name']) ?>
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="far fa-calendar-alt mr-1"></i> 
                                <?= date('d M Y, H:i', strtotime($report['created_at'])) ?>
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="fas fa-tag mr-1"></i> 
                                <?= ucfirst(esc($report['category'])) ?>
                            </span>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        <?= $report['status'] === 'diproses' ? 'bg-yellow-100 text-yellow-800' : 
                           ($report['status'] === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') ?>">
                        <?= ucfirst(esc($report['status'])) ?>
                    </span>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="px-6 py-6">
                <!-- Foto Laporan -->
                <?php if (!empty($report['photo_before'])): ?>
                    <div class="mb-6">
                        <img src="/uploads/<?= $report['photo_before'] ?>" 
                             alt="Foto Laporan" 
                             class="rounded-lg shadow-md w-full h-auto max-h-96 object-cover">
                        <p class="mt-2 text-sm text-gray-500 text-center">Foto Laporan</p>
                    </div>
                <?php endif; ?>

                <!-- Foto Setelah (jika ada) -->
                <?php if (!empty($report['photo_after'])): ?>
                    <div class="mb-6">
                        <img src="/uploads/<?= $report['photo_after'] ?>" 
                             alt="Foto Setelah Penanganan" 
                             class="rounded-lg shadow-md w-full h-auto max-h-96 object-cover">
                        <p class="mt-2 text-sm text-gray-500 text-center">Foto Setelah Penanganan</p>
                    </div>
                <?php endif; ?>

                <!-- Deskripsi -->
                <div class="prose max-w-none
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Deskripsi Laporan</h3>
                    <p class="text-gray-700 whitespace-pre-line"><?= nl2br(esc($report['description'])) ?></p>
                </div>

                <!-- Lokasi -->
                <?php if (!empty($report['location'])): ?>
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Lokasi</h3>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-gray-500 mt-1 mr-2"></i>
                            <p class="text-gray-700"><?= esc($report['location']) ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Informasi Tambahan -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Dilaporkan Oleh</h4>
                            <p class="mt-1 text-sm text-gray-900"><?= esc($report['user_name']) ?></p>
                            <p class="text-sm text-gray-500"><?= esc($report['user_email']) ?></p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Terakhir Diperbarui</h4>
                            <p class="mt-1 text-sm text-gray-900">
                                <?= date('d M Y, H:i', strtotime($report['updated_at'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center
                        <button class="flex items-center text-gray-500 hover:text-red-500">
                            <i class="far fa-heart mr-1"></i>
                            <span><?= $report['upvotes'] ?? 0 ?> Dukungan</span>
                        </button>
                    </div>
                    <div class="flex space-x-3">
                        <a href="/reports" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Kembali
                        </a>
                        <?php if (session()->get('user_id') == $report['user_id'] || session()->get('role') === 'admin'): ?>
                            <a href="/reports/edit/<?= $report['id'] ?>" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-600">
                                Edit Laporan
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
