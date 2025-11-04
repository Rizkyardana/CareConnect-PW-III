<!DOCTYPE html>
<html>
<head>
  <title>Login - CareConnect</title>
  <?= $this->extend('layouts/main') ?>
</head>
<body>
  <?= $this->section('content') ?>
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
          Masuk ke Akun Anda
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Atau
          <a href="/register" class="font-medium text-primary hover:text-blue-500">
            daftar akun baru
          </a>
        </p>
      </div>
      
      <form class="mt-8 space-y-6" action="/login" method="POST">
        <?php if(session()->getFlashdata('error')): ?>
          <p style="color:red"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>
        <div class="rounded-md shadow-sm space-y-4">
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
              <input id="password" name="password" type="password" autocomplete="current-password" required
                class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                placeholder="••••••••">
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" 
              class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              Ingat saya
            </label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-primary hover:text-blue-500">
              Lupa kata sandi?
            </a>
          </div>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150 ease-in-out">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <i class="fas fa-sign-in-alt"></i>
            </span>
            Masuk
          </button>
        </div>
      </form>
    </div>
  </div>
  <?= $this->endSection() ?>
</body>
</html>
