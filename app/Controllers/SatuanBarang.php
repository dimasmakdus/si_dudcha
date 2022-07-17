<?php

namespace App\Controllers;

class SatuanBarang extends BaseController
{
    public function create()
    {
        $this->satuanBarangModel->insert($this->request->getVar());
        return redirect()->to('satuan-barang')->with('success', 'Satuan Barang Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('satuan_barang_id');
        $this->satuanBarangModel->update($id, $this->request->getVar());
        return redirect()->to('satuan-barang')->with('success', 'Satuan Barang Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->satuanBarangModel->delete($id);
        return redirect()->to('satuan-barang')->with('success', 'Satuan Barang Berhasil Dihapus');
    }
}
