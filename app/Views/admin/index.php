<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl"><?= $title ?></h1>
                <p class="mt-1 text-sm text-gray-500">
                    Berikut adalah daftar laporan dari semua pengguna.
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="/reports/create" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Total Laporan -->
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <i class="fas fa-file-alt text-white text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Laporan</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        <?= $total_laporan ?>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menunggu -->
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Menunggu</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        <?= $menunggu ?>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diproses -->
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <i class="fas fa-spinner text-white text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Diproses</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        <?= $diproses ?>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selesai -->
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Selesai</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        <?= $selesai ?>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <!-- Daftar Laporan -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Laporan</h3>
                <p class="mt-1 text-sm text-gray-500">Berikut adalah daftar laporan dari semua pengguna.</p>
            </div>
            
            <?php if (empty($reports)): ?>
                <div class="p-6 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                    <p>Belum ada laporan.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-3">Judul</th>
                                <th class="px-6 py-3">Dilaporkan Oleh</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($reports as $r): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?= esc($r['title']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($r['location']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?= esc($r['user_name'] ?? 'Anonim') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <?= ucfirst(esc($r['category'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= $r['status'] === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($r['status'] === 'diproses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') ?>">
                                        <?= ucfirst(esc($r['status'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?= date('d M Y', strtotime($r['created_at'])) ?></div>
                                    <div class="text-xs text-gray-500"><?= date('H:i', strtotime($r['created_at'])) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="/reports/<?= $r['id'] ?>" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (empty($reports)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-inbox text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada laporan</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan baru.</p>
                <div class="mt-6">
                    <a href="/reports/create" class="btn-primary inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i> Buat Laporan Pertama
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
