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

            // Password hash untuk '123'
            $hashedPassword = '$2y$10$/JuUA1dyfIcp1cO93vyF3OkcORZ5tMLWZSLCPLb5IU4e1.8GWml0e';

            $dataUser = [
                [
                    'username' => 'tama',
                    'password' => $hashedPassword,
                    'role' => 'admin'
                ],
                [
                    'username' => 'pramudya',
                    'password' => $hashedPassword,
                    'role' => 'user'
                ]
            ];

            $userFound = false;

            foreach ($dataUser as $user) {
                if ($username === $user['username']) {
                    $userFound = true;

                    if (password_verify($password, $user['password'])) {
                        session()->set([
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'isLoggedIn' => true
                        ]);
                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Password salah');
                        return redirect()->back();
                    }
                }
            }

            if (!$userFound) {
                session()->setFlashdata('failed', 'Username tidak ditemukan');
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
