<?php

namespace App\Controllers;

class ObatObatan extends BaseController
{
    public function create()
    {
        $this->obatModel->insert($this->request->getVar());
        return redirect()->to('obat-obatan')->with('success', 'Data Obat-Obatan Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('kode_obat');
        $this->obatModel->update($id, $this->request->getVar());
        return redirect()->to('obat-obatan')->with('success', 'Data Obat-Obatan Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->obatModel->delete($id);
        return redirect()->to('obat-obatan')->with('success', 'Data Obat-Obatan Berhasil Dihapus');
    }
}
