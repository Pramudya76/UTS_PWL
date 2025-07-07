<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class TransaksiController extends BaseController
{
    protected $cart;
    protected $client;
    protected $apikey;

    function __construct()
    {
        helper('number');
        helper('form');
        $this->cart = \Config\Services::cart();
        $this->client = new \GuzzleHttp\Client();
        $this->apiKey = env('COST_KEY');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function index()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_keranjang', $data);
    }

    public function cart_add()
    {
        $this->cart->insert(array(
            'id'        => $this->request->getPost('id'),
            'qty'       => 1,
            'price'     => $this->request->getPost('harga'),
            'name'      => $this->request->getPost('nama'),
            'options'   => array('foto' => $this->request->getPost('foto'))
        ));
        session()->setflashdata('success', 'Produk berhasil ditambahkan ke keranjang. (<a href="' . base_url() . 'keranjang">Lihat</a>)');
        return redirect()->to(base_url('/'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();
        session()->setflashdata('success', 'Keranjang Berhasil Dikosongkan');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_edit()
    {
        $i = 1;
        foreach ($this->cart->contents() as $value) {
            $this->cart->update(array(
                'rowid' => $value['rowid'],
                'qty'   => $this->request->getPost('qty' . $i++)
            ));
        }

        session()->setflashdata('success', 'Keranjang Berhasil Diedit');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);
        session()->setflashdata('success', 'Keranjang Berhasil Dihapus');
        return redirect()->to(base_url('keranjang'));
    }

    public function checkout()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();

        return view('v_checkout', $data);
    }

    public function getLocation()
    {
            //keyword pencarian yang dikirimkan dari halaman checkout
        $search = $this->request->getGet('search');

        $response = $this->client->request(
            'GET', 
            'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search='.$search.'&limit=50', [
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->apiKey,
                ],
            ]
        );

        $body = json_decode($response->getBody(), true); 
        return $this->response->setJSON($body['data']);
    }

    public function getCost()
    { 
            //ID lokasi yang dikirimkan dari halaman checkout
        $destination = $this->request->getGet('destination');

            //parameter daerah asal pengiriman, berat produk, dan kurir dibuat statis
        //valuenya => 64999 : PEDURUNGAN TENGAH , 1000 gram, dan JNE
        $response = $this->client->request(
            'POST', 
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'multipart' => [
                    [
                        'name' => 'origin',
                        'contents' => '64999'
                    ],
                    [
                        'name' => 'destination',
                        'contents' => $destination
                    ],
                    [
                        'name' => 'weight',
                        'contents' => '1000'
                    ],
                    [
                        'name' => 'courier',
                        'contents' => 'jne'
                    ]
                ],
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->apiKey,
                ],
            ]
        );

        $body = json_decode($response->getBody(), true); 
        return $this->response->setJSON($body['data']);
    }

    public function buy()
    {
        if ($this->request->getPost()) { 
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'total_harga' => $this->request->getPost('total_harga'),
                'alamat' => $this->request->getPost('alamat'),
                'ongkir' => $this->request->getPost('ongkir'),
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->transaction->insert($dataForm);
            $last_insert_id = $this->transaction->getInsertID();

            $produkModel = new \App\Models\ProductModel(); // Pastikan sudah ada model ini

            foreach ($this->cart->contents() as $value) {
                // Simpan detail transaksi
                $dataFormDetail = [
                    'transaction_id' => $last_insert_id,
                    'product_id' => $value['id'],
                    'jumlah' => $value['qty'],
                    'diskon' => 0,
                    'subtotal_harga' => $value['qty'] * $value['price'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                $this->transaction_detail->insert($dataFormDetail);

                // Kurangi jumlah produk di database
                $produk = $produkModel->find($value['id']);
                if ($produk && $produk['jumlah'] >= $value['qty']) {
                    $produkModel->update($value['id'], [
                        'jumlah' => $produk['jumlah'] - $value['qty']
                    ]);
                } else {
                    // Stok tidak cukup (opsional: batalkan pembelian jika perlu)
                    session()->setFlashdata('error', 'Stok produk "' . $value['name'] . '" tidak mencukupi.');
                    return redirect()->to(base_url('keranjang'));
                }
            }

            $this->cart->destroy();

            return redirect()->to(base_url())->with('success', 'Transaksi berhasil dilakukan.');
        }
    }


    public function chart()
    {
        $model = new \App\Models\TransactionModel();

        // Ambil total transaksi per tanggal berdasarkan status
        $results = $model->select("DATE(created_at) as tanggal, status, SUM(total_harga) as total")
            ->groupBy('tanggal, status')
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $dataChart = [];
        foreach ($results as $row) {
            $tanggal = $row['tanggal'];
            $status = $row['status'];

            if (!isset($dataChart[$status])) {
                $dataChart[$status] = [];
            }

            $dataChart[$status][$tanggal] = (int) $row['total'];
        }

        // Ambil semua tanggal unik
        $labels = [];
        foreach ($results as $row) {
            $labels[] = $row['tanggal'];
        }
        $labels = array_unique($labels);
        sort($labels);

        // Siapkan series per status
        $statusLabels = [
            0 => 'Belum Selesai',
            1 => 'Sudah Selesai',
            2 => 'Dibatalkan'
        ];

        $series = [];
        foreach ($dataChart as $status => $values) {
            $dataPerTanggal = [];
            foreach ($labels as $tanggal) {
                $dataPerTanggal[] = $values[$tanggal] ?? 0;
            }
            $series[] = [
                'name' => $statusLabels[$status] ?? 'Status Tidak Diketahui',
                'data' => $dataPerTanggal
            ];
        }

        return view('chartMenu', [
            'labels' => json_encode($labels),
            'series' => json_encode($series)
        ]);
    }


    public function selesaikan($id)
    {
        $this->transaction->update($id, [
            'status' => 1,
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        session()->setFlashdata('success', 'Transaksi berhasil diselesaikan.');
        return redirect()->back();
    }

    public function batalkan($id)
    {
        // Ambil semua detail produk dari transaksi
        $detailModel = new \App\Models\TransactionDetailModel();
        $produkModel = new \App\Models\ProductModel();

        $detailTransaksi = $detailModel->where('transaction_id', $id)->findAll();

        // Kembalikan jumlah stok
        foreach ($detailTransaksi as $item) {
            $produk = $produkModel->find($item['product_id']);
            if ($produk) {
                $produkModel->update($item['product_id'], [
                    'jumlah' => $produk['jumlah'] + $item['jumlah']
                ]);
            }
        }

        // Update status transaksi menjadi "dibatalkan"
        $this->transaction->update($id, ['status' => 2]);

        return redirect()->to(base_url('profile'))->with('success', 'Transaksi telah dibatalkan dan stok telah dikembalikan.');
    }




}
