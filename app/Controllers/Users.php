<?php

namespace App\Controllers;

class Users extends BaseController
{
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
            'id_user_role' => $this->request->getVar('role'),
            'is_active' => $this->request->getVar('status')
        ]);
        return redirect()->to('pengguna')->with('success', 'Data Pengguna Berhasil Diubah');
    }

    public function updatePassword()
    {
        $id = $this->request->getVar('id_user');
        $this->userModel->update($id, [
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);

        echo 'success';
    }

    public function remove($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('pengguna')->with('success', 'Data Pengguna Berhasil Dihapus');
    }
}
