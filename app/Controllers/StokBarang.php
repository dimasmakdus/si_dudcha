<?php

namespace App\Controllers;

class StokBarang extends BaseController
{
    public function stokAdd()
    {
        return view('stok_barang/stok_add', [
            'title' => 'Form Tambah Data Stok Barang',
            'navLink' => 'stok-barang',
            'accessRight' => $this->accessRights,
            'kodeBarang' => $this->barangModel->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')->findAll()
        ]);
    }

    public function create()
    {
        $post = $this->request->getVar();
        $kode_barang = $post['kode-stok-barang'];
        $jumlah = $post['jumlah'];
        $stok_barang = $this->stokBarangModel->find($kode_barang);
        $data_barang = $this->barangModel->find($kode_barang);

        if ($stok_barang == null) {
            $this->stokBarangModel->insert([
                'kode_barang' => $data_barang['kode_barang'],
                'nama_barang' => $data_barang['nama_barang'],
                'jumlah' => $jumlah,
                'satuan' => $data_barang['satuan']
            ]);
        } else {
            $this->stokBarangModel->update($stok_barang['kode_barang'], [
                'nama_barang' => $stok_barang['nama_barang'],
                'jumlah' => $stok_barang['jumlah'] + $jumlah,
                'satuan' => $stok_barang['satuan']
            ]);
        }

        return redirect()->to('stok-barang')->with('success', 'Data Stok Barang Berhasil Ditambahkan');
    }
}
