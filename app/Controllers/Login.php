<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login/login');
    }

    public function updateProfile()
    {
        $id_user = $this->request->getVar('id_user');
        $upload = $this->request->getFile('user_photo');
        $fileName = $upload->getRandomName();

        if ($upload->getSize() > 0) {
            $dataUser = [
                'full_name' => $this->request->getVar('full_name'),
                'email' => $this->request->getVar('email'),
                'user_photo' => $fileName,
            ];
        } else {
            $dataUser = [
                'full_name' => $this->request->getVar('full_name'),
                'email' => $this->request->getVar('email'),
            ];
        }

        $status = $this->userModel->update($id_user, $dataUser);

        if ($status && $upload->getSize() > 0) {
            $upload->move(ROOTPATH . 'public/uploads/users', $fileName);
        }

        session()->destroy();
        return redirect()->to('/login');
    }

    public function process()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $this->userModel->where(['email' => $email])->where('is_active', 'y')->first();

        if ($dataUser) {
            $roleById = $this->roleModel->find($dataUser['id_user_role']);
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'email' => $dataUser['email'],
                    'name' => $dataUser['full_name'],
                    'id_user' => $dataUser['id_user'],
                    'user_photo' => $dataUser['user_photo'],
                    'roles' => $roleById,
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('dashboard'))->with('success', "Selamat datang <b>" . $dataUser['full_name'] . "</b>, di Aplikasi Sistem Informasi Pengelolaan Barang DUDCHA");
            } else {
                session()->setFlashdata('error', 'Password yang di input salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Pengguna tidak terdaftar');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
