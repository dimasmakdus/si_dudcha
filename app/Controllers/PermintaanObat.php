<?php

namespace App\Controllers;

class PermintaanObat extends BaseController
{
    public function permintaanAdd()
    {
        return view('permintaan/permintaanObat_add', [
            'title' => 'Form Tambah Data Permintaan Obat',
            'navLink' => 'permintaan_obat'
        ]);
    }

    public function permintaanEdit($id)
    {
        $getPermintaanById = $this->permintaanModel->find($id);

        return view('permintaan/permintaanObat_edit', [
            'title' => 'Form Ubah Data permintaan Obat',
            'navLink' => 'permintaan_obat',
            'getPermintaan' => $getPermintaanById
        ]);
    }
}
