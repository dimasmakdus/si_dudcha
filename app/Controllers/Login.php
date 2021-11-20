<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login/login');
    }

    public function process()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $this->userModel->where(['email' => $email])->first();
        $roleById = $this->roleModel->find($dataUser['id_user_role']);

        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'email' => $dataUser['email'],
                    'name' => $dataUser['full_name'],
                    'roles' => $roleById['nama_role'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
