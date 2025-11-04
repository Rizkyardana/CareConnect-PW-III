<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    // 🔹 Tampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // 🔹 Proses login user
    public function loginPost()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            $pass = $user['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                // Set session data
                $userData = [
                    'user_id'   => $user['id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ];
                
                $session->set($userData);

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, ' . $user['name'] . '!');
                } else {
                    return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['name'] . '!');
                }
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan.');
            return redirect()->back();
        }
    }

    // 🔹 Tampilkan halaman registrasi
    public function register()
    {
        return view('auth/register');
    }

    // 🔹 Proses registrasi user baru
    public function registerPost()
    {
        $model = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user' // default role user biasa
        ];

        $model->save($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // 🔹 Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
