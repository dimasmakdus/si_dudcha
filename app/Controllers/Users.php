<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function userForm()
    {
        $roles = $this->roleModel->findAll();
        return view('user/user_form', [
            'title' => 'Form Tambah Data Pengguna',
            'navLink' => 'pengguna',
            'roles' => $roles,
            'accessRight' => $this->accessRights
        ]);
    }
    public function userEdit($id)
    {
        $roles = $this->roleModel->findAll();
        $getUserById = $this->userModel->find($id);
        $is_active = [
            'y' => 'Aktif',
            'n' => 'Tidak Aktif'
        ];

        return view('user/user_edit', [
            'title' => 'Form Ubah Data Pengguna',
            'navLink' => 'pengguna',
            'roles' => $roles,
            'is_active' => $is_active,
            'getUser' => $getUserById,
            'accessRight' => $this->accessRights
        ]);
    }

    public function create()
    {
        $this->userModel->insert([
            'full_name' => $this->request->getVar('nama-lengkap'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'id_user_role' => $this->request->getVar('role'),
            'is_active' => $this->request->getVar('status')
        ]);
        return redirect()->to('pengguna')->with('success', 'Data Pengguna Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('id_user');
        $this->userModel->update($id, [
            'full_name' => $this->request->getVar('nama-lengkap'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'id_user_role' => $this->request->getVar('role'),
            'is_active' => $this->request->getVar('status')
        ]);
        return redirect()->to('pengguna')->with('success', 'Data Pengguna Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('pengguna')->with('success', 'Data Pengguna Berhasil Dihapus');
    }
}
