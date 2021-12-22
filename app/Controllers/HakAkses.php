<?php

namespace App\Controllers;

class HakAkses extends BaseController
{
    public function create()
    {
        $this->roleModel->insert($this->request->getVar());
        return redirect()->to('role-pengguna')->with('success', 'Hak Akses Berhasil Ditambahkan');
    }

    public function remove($id)
    {
        $db = \Config\Database::connect();
        $db->query("DELETE FROM tbl_hak_akses WHERE id_role = $id");
        $this->roleModel->delete($id);
        return redirect()->to('role-pengguna')->with('success', 'Hak Akses Berhasil Dihapus');
    }
}
