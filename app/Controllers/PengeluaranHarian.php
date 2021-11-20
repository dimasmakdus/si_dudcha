<?php

namespace App\Controllers;

class PengeluaranHarian extends BaseController
{
    public function pengeluaranAdd()
    {
        return view('pengeluaranHarian/pengeluaran_add', [
            'title' => 'Form Tambah Data Pengeluaran Harian',
            'navLink' => 'pengeluaran_harian'
        ]);
    }

    public function pengeluaranEdit($id)
    {
        $getPengeluaranById = $this->pengeluaranModel->find($id);

        return view('pengeluaranHarian/pengeluaran_edit', [
            'title' => 'Form Ubah Data Pengeluaran Harian',
            'navLink' => 'pengeluaran_harian',
            'getpengeluaran' => $getPengeluaranById
        ]);
    }
}
