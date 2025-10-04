<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke halaman utama
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        
        // Tampilkan halaman login
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Cari user di database berdasarkan username
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // Jika user ditemukan, verifikasi password
            $pass = $user['password'];
            $verify_pass = password_verify($password, $pass);
            
            if ($verify_pass) {
                // Jika password benar, buat session
                $ses_data = [
                    'user_id'       => $user['user_id'],
                    'username'      => $user['username'],
                    'nama_lengkap'  => $user['nama_depan'] . ' ' . $user['nama_belakang'],
                    'role'          => $user['role'],
                    'isLoggedIn'    => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/'); // Redirect ke halaman utama
            } else {
                // Jika password salah
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            // Jika username tidak ditemukan
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}