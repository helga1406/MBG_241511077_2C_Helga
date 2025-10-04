<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // Form login
    public function login()
    {
        return view('auth/login');
    }

    // Proses login
    public function processLogin()
    {
        $session   = session();
        $userModel = new UserModel();

        $email    = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        // Validasi input kosong
        if (empty($email) || empty($password)) {
            $session->setFlashdata('msg', 'Email dan password wajib diisi!');
            return redirect()->to(base_url('login'));
        }

        // Cari user berdasarkan email
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Cek password pakai MD5 (sesuai DB)
            if (md5($password) === $user['password']) {
                // Simpan session
                $ses_data = [
                    'id'        => $user['id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'isLoggedIn'=> true   // konsisten dengan filter
                ];
                $session->set($ses_data);

                // Redirect sesuai role
                if ($user['role'] == 'gudang') {
                    return redirect()->to(base_url('gudang/dashboard'));
                } elseif ($user['role'] == 'dapur') {
                    return redirect()->to(base_url('dapur/dashboard'));
                }
            } else {
                $session->setFlashdata('msg', 'Password salah!');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('msg', 'Email tidak ditemukan!');
            return redirect()->to(base_url('login'));
        }
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
