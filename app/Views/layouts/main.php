<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'CareConnect' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card {
            @apply bg-white rounded-lg shadow-md p-6 mb-6;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/" class="text-white font-bold text-xl">
                            <i class="fas fa-hands-helping mr-2"></i>CareConnect
                        </a>
                    </div>
                    <?php if (session()->get('logged_in')): ?>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <?php if (session()->get('role') === 'admin'): ?>
                                <!-- Admin Navigation -->
                                <a href="/admin/dashboard" 
                                   class="<?= (url_is('admin/dashboard') || url_is('admin/dashboard/*')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> 
                                          px-3 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard Admin
                                </a>
                                <a href="/admin/reports" 
                                   class="<?= (url_is('admin/reports') || url_is('admin/reports/*')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> 
                                          px-3 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-list-alt mr-1"></i> Kelola Laporan
                                </a>
                                <a href="/admin/users" 
                                   class="<?= (url_is('admin/users') || url_is('admin/users/*')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> 
                                          px-3 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-users mr-1"></i> Manajemen Pengguna
                                </a>
                            <?php else: ?>
                                <!-- Regular User Navigation -->
                                <a href="/dashboard" 
                                   class="<?= (url_is('dashboard') || url_is('dashboard/*')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> 
                                          px-3 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-home mr-1"></i> Beranda
                                </a>
                                <a href="/reports" 
                                   class="<?= (url_is('reports') || url_is('reports/*')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> 
                                          px-3 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-file-alt mr-1"></i> Laporan Saya
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (session()->get('logged_in')): ?>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="ml-3 relative">
                            <div>
                                <button type="button" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Buka menu profil</span>
                                    <span class="text-white px-3 py-2 text-sm font-medium">
                                        <?= session()->get('name') ?>
                                    </span>
                                    <i class="fas fa-chevron-down text-gray-300 ml-1"></i>
                                </button>
                            </div>
                            <div id="user-dropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                <?php if (session()->get('role') === 'admin'): ?>
                                <a href="/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                                </a>
                                <?php else: ?>
                                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fas fa-home mr-2"></i>Beranda
                                </a>
                                <?php endif; ?>
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fas fa-user-circle mr-2"></i>Profil Saya
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6 space-x-4">
                        <a href="/login" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Masuk
                        </a>
                        <a href="/register" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium">
                            Daftar
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; <?= date('Y') ?> CareConnect. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
    // Toggle dropdown menu
    document.addEventListener('DOMContentLoaded', function() {
        const userMenu = document.getElementById('user-menu');
        const dropdown = document.getElementById('user-dropdown');
        
        if (userMenu && dropdown) {
            userMenu.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', function() {
                dropdown.classList.add('hidden');
            });
        }
    });
    </script>
</body>
</html>