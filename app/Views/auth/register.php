<!DOCTYPE html>
<html>
<head>
  <title>Register - CareConnect</title>
  <?= $this->extend('layouts/main') ?>
</head>
<body>
  <?= $this->section('content') ?>
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
          Buat Akun Baru
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Sudah punya akun?
          <a href="/login" class="font-medium text-primary hover:text-blue-500">
            Masuk disini
          </a>
        </p>
      </div>
      
      <form class="mt-8 space-y-6" action="/register" method="POST">
        <div class="rounded-md shadow-sm space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
              </div>
              <input id="name" name="name" type="text" required 
                class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                placeholder="Nama lengkap">
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
              </div>
              <input id="email" name="email" type="email" required 
                class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                placeholder="email@example.com">
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
              </div>
              <input id="password" name="password" type="password" required
                class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                placeholder="••••••••">
            </div>
          </div>

          <div>
            <label for="password_confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
              </div>
              <input id="password_confirm" name="password_confirm" type="password" required
                class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                placeholder="••••••••">
            </div>
          </div>
        </div>

        <div class="flex items-center">
          <input id="terms" name="terms" type="checkbox" required
            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
          <label for="terms" class="ml-2 block text-sm text-gray-700">
            Saya setuju dengan <a href="#" class="text-primary hover:text-blue-500">Syarat & Ketentuan</a>
          </label>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150 ease-in-out">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <i class="fas fa-user-plus"></i>
            </span>
            Daftar Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
  <?= $this->endSection() ?>
</body>
</html>
