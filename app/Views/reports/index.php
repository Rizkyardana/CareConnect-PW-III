<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Laporan Saya
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Ringkasan dan statistik laporan Anda
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="/reports/create" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
                </a>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Laporan -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Laporan</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900"><?= $total_laporan ?? 0 ?></div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menunggu -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Menunggu</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900"><?= $menunggu ?? 0 ?></div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diproses -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-400 rounded-md p-3">
                            <i class="fas fa-spinner text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Diproses</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900"><?= $diproses ?? 0 ?></div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selesai -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Selesai</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900"><?= $selesai ?? 0 ?></div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <?php if(isset($total_laporan) && $total_laporan > 0): ?>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Progres Laporan Anda</h3>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $persentase_selesai ?? 0 ?>%"></div>
            </div>
            <div class="mt-2 text-sm text-gray-500">
                <?= $selesai ?? 0 ?> dari <?= $total_laporan ?? 0 ?> laporan telah selesai diproses
            </div>
        </div>
        <?php endif; ?>

        <!-- Daftar Laporan Terbaru -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Laporan Terbaru</h3>
                        <p class="mt-1 text-sm text-gray-500">Daftar 5 laporan terbaru yang Anda buat.</p>
                    </div>
                    <a href="/reports" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Lihat semua laporan <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
            
            <?php if (empty($reports)): ?>
                <div class="p-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-blue-50">
                        <i class="fas fa-inbox text-blue-400 text-4xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada laporan</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda belum membuat laporan apapun.</p>
                    <div class="mt-6">
                        <a href="/reports/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-plus mr-2"></i> Buat Laporan Pertama Anda
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-3">Judul</th>
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
                    <a href="/reports" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Lihat semua laporan <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>