<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = md5($this->request->getPost('password')); // hash harus sama dengan DB

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if ($user['password'] === $password) {
                // Simpan ke session
                $ses_data = [
                    'id'        => $user['id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                // Redirect sesuai role
                if ($user['role'] == 'gudang') {
                    return redirect()->to('/gudang/dashboard');
                } elseif ($user['role'] == 'dapur') {
                    return redirect()->to('/dapur/dashboard');
                } else {
                    $session->setFlashdata('msg', 'Role tidak dikenali!');
                    return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('msg', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
