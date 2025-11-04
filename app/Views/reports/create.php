<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Buat Laporan Baru</h2>
                <p class="mt-1 text-sm text-gray-500">Laporkan masalah yang Anda temukan di sekitar Anda.</p>
            </div>
            
            <form action="/reports/store" method="post" enctype="multipart/form-data" class="p-6">
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        <p><?= session()->getFlashdata('error') ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="space-y-6">
                    <!-- Judul Laporan -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Laporan <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" required
                                class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Contoh: Sampah Menumpuk di Jalan Raya">
                        </div>
                    </div>
                    
                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <select id="category" name="category" required
                                class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="lingkungan">Lingkungan</option>
                                <option value="sosial">Sosial</option>
                                <option value="hewan">Hewan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Masalah <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="4" required
                                class="focus:ring-primary focus:border-primary block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                                placeholder="Jelaskan masalah yang Anda temukan dengan detail"></textarea>
                        </div>
                    </div>
                    
                    <!-- Lokasi -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <div class="mt-1">
                            <input type="text" name="location" id="location"
                                class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Contoh: Jl. Contoh No. 123, Kec. Contoh, Kota Contoh">
                        </div>
                    </div>
                    
                    <!-- Unggah Foto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto Bukti</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="photo_before" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-blue-500 focus-within:outline-none">
                                        <span>Unggah file</span>
                                        <input id="photo_before" name="photo_before" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end space-x-4 pt-6">
                        <a href="/reports" class="text-sm font-medium text-gray-700 hover:text-gray-500">
                            Batal
                        </a>
                        <button type="submit" class="btn-primary inline-flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
