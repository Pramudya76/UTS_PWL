<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('v_home');
    }

    public function stokBarang() {
        return view('v_stokBarang');
    }

    public function pelanggan() {
        return view('v_pelanggan');
    }

    public function kelolaBarang() {
        return view('v_kelolaBarang');
    }

    public function dashboard() {
        return view('v_dashboard');
    }

    public function produk() {
        return view('v_produk');
    }

    public function keranjang() {
        return view('v_keranjang');
    }

    public function riwayatBelanja() {
        return view('v_riwayatBelanja');
    }


}
