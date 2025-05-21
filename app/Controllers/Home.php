<?php

namespace App\Controllers;

use App\Models\ProductModel; 

class Home extends BaseController
{
    protected $product;

    function __construct()
    {
        $this->product = new ProductModel();
    }


    public function index(): string
    {
        $product = $this->product->findAll();
        $data['product'] = $product;
        return view('v_home', $data);
    }

    public function stokBarang() {
        $data['barang'] = [
            [
                'nama' => 'Beras 1 kg',
                'kategori' => 'Sembako',
                'stok' => 120,
                'harga' => 15000,
                'tanggal_masuk' => '2025-04-20'
            ],
            [
                'nama' => 'Gula Pasir 1kg',
                'kategori' => 'Sembako',
                'stok' => 80,
                'harga' => 14000,
                'tanggal_masuk' => '2025-04-19'
            ],
            [
                'nama' => 'Minyak Goreng 1L',
                'kategori' => 'Sembako',
                'stok' => 60,
                'harga' => 18500,
                'tanggal_masuk' => '2025-04-22'
            ],
            [
                'nama' => 'Indomie Goreng',
                'kategori' => 'Makanan Instan',
                'stok' => 200,
                'harga' => 3500,
                'tanggal_masuk' => '2025-04-21'
            ],
            [
                'nama' => 'Kopi Kapal Api 65gr',
                'kategori' => 'Minuman',
                'stok' => 95,
                'harga' => 2800,
                'tanggal_masuk' => '2025-04-23'
            ]
        ];

        return view('v_stokBarang', $data);
    }

    public function pelanggan() {
        $dataUser['dataUser'] = [
            [
                'username' => 'tama',
                'role' => 'admin'
            ],
            [
                'username' => 'pramudya',
                'role' => 'user'
            ]
        ];

        return view('v_pelanggan', $dataUser);
    }

    public function kelolaBarang() {
        return view('v_kelolaBarang');
    }

    public function dashboard() {
        return view('v_dashboard');
    }

    public function produk() {
        $data['barang'] = [
            [
                'nama' => 'Beras 1 kg',
                'kategori' => 'Sembako',
                'stok' => 120,
                'harga' => 15000,
                'tanggal_masuk' => '2025-04-20'
            ],
            [
                'nama' => 'Gula Pasir 1kg',
                'kategori' => 'Sembako',
                'stok' => 80,
                'harga' => 14000,
                'tanggal_masuk' => '2025-04-19'
            ],
            [
                'nama' => 'Minyak Goreng 1L',
                'kategori' => 'Sembako',
                'stok' => 60,
                'harga' => 18500,
                'tanggal_masuk' => '2025-04-22'
            ],
            [
                'nama' => 'Indomie Goreng',
                'kategori' => 'Makanan Instan',
                'stok' => 200,
                'harga' => 3500,
                'tanggal_masuk' => '2025-04-21'
            ],
            [
                'nama' => 'Kopi Kapal Api 65gr',
                'kategori' => 'Minuman',
                'stok' => 95,
                'harga' => 2800,
                'tanggal_masuk' => '2025-04-23'
            ]
        ];

        return view('v_produk', $data);
    }

    public function keranjang() {
        return view('v_keranjang');
    }

    public function riwayatBelanja() {
        return view('v_riwayatBelanja');
    }

    


}
