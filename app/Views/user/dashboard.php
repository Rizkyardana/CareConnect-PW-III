<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Semua Laporan
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Daftar semua laporan dari seluruh pengguna
                </p>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <!-- Daftar Laporan -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Laporan</h3>
                <p class="mt-1 text-sm text-gray-500">Semua laporan yang telah dibuat oleh seluruh pengguna.</p>
            </div>
            
            <?php if (empty($reports)): ?>
                <div class="p-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-blue-50">
                        <i class="fas fa-inbox text-blue-400 text-4xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada laporan</h3>
                    <p class="mt-1 text-sm text-gray-500">Tidak ada laporan yang tersedia saat ini.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-3">Judul</th>
                                <th class="px-6 py-3">Dilaporkan Oleh</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($reports as $report): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= esc($report['title']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($report['category'] ?? 'Tidak ada kategori') ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($report['user_name'] ?? 'Tidak diketahui') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d M Y', strtotime($report['created_at'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusClass = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-green-100 text-green-800'
                                    ][$report['status']] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                        <?= ucfirst($report['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/reports/<?= $report['id'] ?>" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Menampilkan <?= count($reports) ?> dari <?= $total_laporan ?> laporan</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>