<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel; // tambahkan model
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $user;

    public function __construct()
    {
        helper('form');
        $this->user = new UserModel(); 
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->user->where(['username' => $username])->first(); 

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {
                        session()->set([
                            'user_id'  => $dataUser['id'],  
                            'username' => $dataUser['username'],
                            'role' => $dataUser['role'],
                            'isLoggedIn' => TRUE
                        ]);

                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        return view('v_login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function register()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]|is_unique[user.username]',
                'email'    => 'required|valid_email|is_unique[user.email]',
                'password' => 'required|min_length[7]',
                'confirm_password' => 'required|matches[password]',
            ];

            if ($this->validate($rules)) {

                $username = $this->request->getVar('username');
                $email    = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $data = [
                    'username' => $username,
                    'email'    => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role'     => 'guest'
                ];

                $this->user->insert($data);

                session()->setFlashdata('success', 'Akun berhasil didaftarkan, silakan login.');
                return redirect()->to('login');
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        return view('v_register'); 
    }




}
