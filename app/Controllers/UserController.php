<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TransactionModel;

class UserController extends BaseController
{
    protected $user;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->user = new UserModel();
    }

    public function profile()
    {
        $username = session()->get('username');
        $dataUser = $this->user->where('username', $username)->first();

        return view('users-profile', ['user' => $dataUser]);
    }

    public function update($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->back()->with('failed', 'User tidak ditemukan.');
        }

        if ($this->request->getPost('check')) {
            $file = $this->request->getFile('foto');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $user['username'] . '.jpg';
                $file->move(ROOTPATH . 'public/img', $newName, true);
            }
        }
        
        $this->user->update($id, [
            'username' => $user['username'], 
        ]);

        session()->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to(base_url('usersProfile'));
    }

}
