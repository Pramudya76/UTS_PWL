<?php

namespace App\Controllers;

use App\Models\ProductModel; 
use App\Models\TransactionModel; 
use App\Models\TransactionDetailModel; 
use App\Models\UserModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;
    protected $userModel;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
        $this->userModel = new UserModel();
    }


    public function index(): string
    {
        $product = $this->product->findAll();
        $data['product'] = $product;
        return view('v_home', $data);
    }

    

    public function pelanggan() {
        $data['users'] = $this->userModel->findAll();
        return view('v_pelanggan', $data);
    }

    public function dataTransaksi()
    {
        $model = new \App\Models\TransactionModel();
        $transaksi = $model->findAll(); 

        return view('v_DataTransaksi', ['transaksi' => $transaksi]);
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
