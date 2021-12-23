<?php

namespace App\Controllers;

class StokObat extends BaseController
{
    public function stokAdd()
    {
        return view('stok_obat/stok_add', [
            'title' => 'Form Tambah Data Stok Obat',
            'navLink' => 'stok-obat',
            'accessRight' => $this->accessRights,
            'kodeObat' => $this->obatModel->findAll()
        ]);
    }

    public function create()
    {
        $post = $this->request->getVar();
        $kode_obat = $post['kode-stok-obat'];
        $jumlah = $post['jumlah'];
        $stok_obat = $this->stokObatModel->find($kode_obat);
        $data_obat = $this->obatModel->find($kode_obat);

        if ($stok_obat == null) {
            $this->stokObatModel->insert([
                'kode_obat' => $data_obat['kode_obat'],
                'nama_obat' => $data_obat['nama_obat'],
                'jumlah' => $jumlah,
                'satuan' => $data_obat['satuan']
            ]);
        } else {
            $this->stokObatModel->update($stok_obat['kode_obat'], [
                'nama_obat' => $stok_obat['nama_obat'],
                'jumlah' => $stok_obat['jumlah'] + $jumlah,
                'satuan' => $stok_obat['satuan']
            ]);
        }

        return redirect()->to('stok-obat')->with('success', 'Data Stok Obat Berhasil Ditambahkan');
    }
}
