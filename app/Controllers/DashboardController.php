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
            $data['menu'] = ['Kelola User', 'Lihat Stok Barang'];
            $data['message'] = 'Selamat datang Admin!';
        } else {
            // Data khusus user biasa
            $data['menu'] = ['Lihat Profil', 'Memesan Barang', 'Melihat Riwayat Pesanan', 'Melihat Keranjang Pesanan'];
            $data['message'] = 'Selamat datang User!';
        }

        return view('v_dashboard', $data);
    }
}
