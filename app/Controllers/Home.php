<?php

namespace App\Controllers;

use App\Models\ProductModel; 
use App\Models\TransactionModel; 
use App\Models\TransactionDetailModel; 

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
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

    public function checkout() {
        return view('v_checkout');
    }

    public function profile()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_profile', $data);
    }


}
