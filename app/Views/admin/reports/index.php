<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Manajemen Laporan
                </h2>
                <p class="mt-1 text-sm text-gray-500">Kelola semua laporan yang masuk dari pengguna</p>
            </div>
            <div class="mt-4 flex md:mt-0">
                <a href="/admin/dashboard" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 gap-5 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Laporan -->
            <a href="/admin/reports" class="hover:shadow-md transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full <?= ($status === 'all') ? 'ring-2 ring-primary' : '' ?>">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-file-alt text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Laporan</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= $total_reports ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menunggu -->
            <a href="/admin/reports?status=menunggu" class="hover:shadow-md transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full <?= ($status === 'menunggu') ? 'ring-2 ring-yellow-500' : '' ?>">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <i class="far fa-clock text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Menunggu</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= $menunggu_count ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Diproses -->
            <a href="/admin/reports?status=diproses" class="hover:shadow-md transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full <?= ($status === 'diproses') ? 'ring-2 ring-blue-500' : '' ?>">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-tasks text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Diproses</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= $diproses_count ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Selesai -->
            <a href="/admin/reports?status=selesai" class="hover:shadow-md transition-shadow duration-200">
                <div class="bg-white overflow-hidden shadow rounded-lg h-full <?= ($status === 'selesai') ? 'ring-2 ring-green-500' : '' ?>">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Selesai</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900"><?= $selesai_count ?></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Reports List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul Laporan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelapor
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="reports-container">
                        <?= view('admin/reports/partials/report_items', ['reports' => $reports]) ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <?php if ($pager->hasPrevious()): ?>
                            <a href="<?= $pager->getPreviousPage() ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Sebelumnya
                            </a>
                        <?php else: ?>
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white">
                                Sebelumnya
                            </span>
                        <?php endif; ?>
                        
                        <?php if ($pager->hasNext()): ?>
                            <a href="<?= $pager->getNextPage() ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Selanjutnya
                            </a>
                        <?php else: ?>
                            <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white">
                                Selanjutnya
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Halaman
                                <span class="font-medium"><?= $pager->getCurrentPage() ?></span>
                                dari
                                <span class="font-medium"><?= $pager->getPageCount() ?></span>
                                - Total
                                <span class="font-medium"><?= $pager->getTotal() ?></span>
                                data
                            </p>
                        </div>
                        <div>
                            <?= $pager->links('default', 'pagination') ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- JavaScript for AJAX loading -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle infinite scroll
                let loading = false;
                let currentPage = <?= $pager->getCurrentPage() ?? 1 ?>;
                const totalPages = <?= $pager->getPageCount() ?? 1 ?>;
                const container = document.getElementById('reports-container');
                
                // Only enable infinite scroll if there are multiple pages
                if (totalPages > 1) {
                    window.addEventListener('scroll', function() {
                        // Load more when user is near the bottom of the page
                        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 500) && !loading && currentPage < totalPages) {
                            loadMoreData();
                        }
                    });
                }
                
                function loadMoreData() {
                    if (loading) return;
                    
                    loading = true;
                    currentPage++;
                    
                    // Show loading indicator
                    const loadingRow = document.createElement('tr');
                    loadingRow.id = 'loading-row';
                    loadingRow.innerHTML = `
                        <td colspan="6" class="px-6 py-4 text-center">
                            <div class="flex justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                            </div>
                        </td>
                    `;
                    container.appendChild(loadingRow);
                    
                    // Build URL with current status filter and new page number
                    const url = new URL(window.location.href);
                    url.searchParams.set('page', currentPage);
                    
                    // Load more data
                    fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Remove loading row
                        const loadingRow = document.getElementById('loading-row');
                        if (loadingRow) {
                            loadingRow.remove();
                        }
                        
                        if (data.html) {
                            // Append new data
                            container.insertAdjacentHTML('beforeend', data.html);
                            
                            // Update URL without page reload
                            window.history.pushState({}, '', url.toString());
                        }
                        
                        loading = false;
                    })
                    .catch(error => {
                        console.error('Error loading more data:', error);
                        loading = false;
                        
                        // Remove loading row on error
                        const loadingRow = document.getElementById('loading-row');
                        if (loadingRow) {
                            loadingRow.remove();
                        }
                        
                        // Show error message
                        const errorRow = document.createElement('tr');
                        errorRow.innerHTML = `
                            <td colspan="6" class="px-6 py-4 text-center text-red-500">
                                Gagal memuat data. Silakan muat ulang halaman.
                            </td>
                        `;
                        container.appendChild(errorRow);
                    });
                }
            });
            </script>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
