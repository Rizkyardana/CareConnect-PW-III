<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard Admin</h1>
        
        <!-- Stats Cards -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Laporan -->
            <a href="/admin/reports" class="hover:shadow-lg transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-file-alt text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Laporan</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= number_format($total_reports) ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <span class="font-medium text-blue-600 hover:text-blue-500">
                                Lihat semua laporan <i class="fas fa-arrow-right text-xs"></i>
                                <span class="sr-only">Total laporan</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menunggu -->
            <a href="/admin/reports?status=menunggu" class="hover:shadow-lg transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Menunggu</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= number_format($menunggu) ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <span class="font-medium text-yellow-600 hover:text-yellow-500">
                                Lihat laporan menunggu <i class="fas fa-arrow-right text-xs"></i>
                                <span class="sr-only">Laporan menunggu</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Diproses -->
            <a href="/admin/reports?status=diproses" class="hover:shadow-lg transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-tasks text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Diproses</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= number_format($diproses) ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <span class="font-medium text-blue-600 hover:text-blue-500">
                                Lihat laporan diproses <i class="fas fa-arrow-right text-xs"></i>
                                <span class="sr-only">Laporan diproses</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Selesai -->
            <a href="/admin/reports?status=selesai" class="hover:shadow-lg transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Selesai</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= number_format($selesai) ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <span class="font-medium text-green-600 hover:text-green-500">
                                Lihat laporan selesai <i class="fas fa-arrow-right text-xs"></i>
                                <span class="sr-only">Laporan selesai</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Reports -->
        <div class="mt-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-lg font-medium text-gray-900">Laporan Terbaru</h2>
                    <p class="mt-2 text-sm text-gray-700">Daftar 5 laporan terbaru yang masuk.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="/admin/reports" class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                        Lihat Semua Laporan
                    </a>
                </div>
            </div>
            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    <?php if (empty($recent_reports)): ?>
                        <li class="px-6 py-4 text-center text-gray-500">
                            Tidak ada laporan terbaru.
                        </li>
                    <?php else: ?>
                        <?php foreach ($recent_reports as $report): ?>
                            <li>
                                <a href="/admin/reports/<?= $report['id'] ?>" class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <p class="truncate text-sm font-medium text-blue-600"><?= esc($report['title']) ?></p>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <?php if ($report['status'] === 'menunggu'): ?>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Menunggu
                                                    </span>
                                                <?php elseif ($report['status'] === 'diproses'): ?>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Diproses
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Selesai
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:flex sm:justify-between">
                                            <div class="sm:flex">
                                                <p class="flex items-center text-sm text-gray-500">
                                                    <i class="fas fa-user mr-1.5 h-5 w-5 text-gray-400"></i>
                                                    <?= esc($report['user_name']) ?>
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                    <i class="fas fa-tag mr-1.5 h-5 w-5 text-gray-400"></i>
                                                    <?= esc(ucfirst($report['category'])) ?>
                                                </p>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                <i class="far fa-clock mr-1.5 h-5 w-5 text-gray-400"></i>
                                                <p>
                                                    <?= date('d M Y', strtotime($report['created_at'])) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Kategori Laporan -->
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Laporan Berdasarkan Kategori</h2>
            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-lg
            <div class="px-4 py-5 sm:p-6">
                <?php if (empty($kategori)): ?>
                    <p class="text-center text-gray-500 py-4">Tidak ada data kategori laporan.</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($kategori as $item): ?>
                            <div class="bg-gray-50 overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                            <i class="fas fa-folder text-white text-xl"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate"><?= esc(ucfirst($item['category'])) ?></dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900"><?= number_format($item['total']) ?></div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                    <div class="text-sm">
                                        <a href="/admin/reports?category=<?= urlencode($item['category']) ?>" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Lihat laporan<span class="sr-only"> <?= $item['category'] ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
