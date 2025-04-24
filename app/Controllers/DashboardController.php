<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        // Ambil data dari session
        $username = session()->get('username');
        $role = session()->get('role');

        // Data yang akan dikirim ke view
        $data = [
            'username' => $username,
            'role' => $role,
        ];

        // Tampilkan view sesuai role
        if ($role === 'admin') {
            // Data khusus admin
            $data['menu'] = ['Kelola User', 'Lihat Laporan', 'Pengaturan'];
            $data['message'] = 'Selamat datang Admin!';
        } else {
            // Data khusus user biasa
            $data['menu'] = ['Lihat Profil', 'Riwayat Aktivitas'];
            $data['message'] = 'Selamat datang Pengguna!';
        }

        return view('v_dashboard', $data);
    }
}
