<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = [
                [
                    'username' => 'tama', 
                    'password' => '202cb962ac59075b964b07152d234b70', 
                    'role' => 'admin'
                ],
                [
                    'username' => 'pramudya', 
                    'password' => '202cb962ac59075b964b07152d234b70', 
                    'role' => 'user'
                ]
            ]; // password = 123

            $userFound = false;

            foreach ($dataUser as $user) {
                if ($username === $user['username']) {
                    $userFound = true;

                    if (md5($password) === $user['password']) {
                        session()->set([
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'isLoggedIn' => TRUE
                        ]);
                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Password Salah');
                        return redirect()->back();
                    }
                }
            }

            if (!$userFound) {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

}
