<?php

namespace App\Controllers;

class DataBarang extends BaseController
{
    public function create()
    {
        $this->barangModel->insert($this->request->getVar());
        return redirect()->to('data-barang')->with('success', 'Data Barang Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('kode_barang');
        $this->barangModel->update($id, $this->request->getVar());
        return redirect()->to('data-barang')->with('success', 'Data Barang Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->barangModel->delete($id);
        return redirect()->to('data-barang')->with('success', 'Data Barang Berhasil Dihapus');
    }
}
