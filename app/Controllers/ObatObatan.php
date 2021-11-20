<?php

namespace App\Controllers;

class ObatObatan extends BaseController
{
    public function obatAdd()
    {
        return view('obat-obatan/obat-obatan_add', [
            'title' => 'Form Tambah Data Obat-Obatan',
            'navLink' => 'obat_obatan'
        ]);
    }

    public function obatEdit($id)
    {
        $getObatById = $this->obatModel->find($id);

        return view('obat-obatan/obat-obatan_edit', [
            'title' => 'Form Ubah Data Obat-Obatan',
            'navLink' => 'obat_obatan',
            'getObat' => $getObatById
        ]);
    }
}
