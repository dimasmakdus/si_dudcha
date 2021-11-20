<?php

namespace App\Controllers;

class StokObat extends BaseController
{
    public function stokAdd()
    {
        return view('stok_obat/stok_add', [
            'title' => 'Form Tambah Data Stok Obat',
            'navLink' => 'stok_obat'
        ]);
    }

    public function stokEdit($id)
    {
        $getStokById = $this->stokObatModel->find($id);

        return view('stok_obat/stok_edit', [
            'title' => 'Form Ubah Data Stok Obat',
            'navLink' => 'stok_obat',
            'getStok' => $getStokById
        ]);
    }
}
