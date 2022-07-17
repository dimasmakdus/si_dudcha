<?php

namespace App\Controllers;

class JenisBarang extends BaseController
{
    public function create()
    {
        $this->jenisBarangModel->insert($this->request->getVar());
        return redirect()->to('jenis-barang')->with('success', 'Data Jenis Barang Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('jenis_barang_id');
        $this->jenisBarangModel->update($id, $this->request->getVar());
        return redirect()->to('jenis-barang')->with('success', 'Data Jenis Barang Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->jenisBarangModel->delete($id);
        return redirect()->to('jenis-barang')->with('success', 'Data Jenis Barang Berhasil Dihapus');
    }
}
