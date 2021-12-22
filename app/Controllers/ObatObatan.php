<?php

namespace App\Controllers;

class ObatObatan extends BaseController
{
    public function obatAdd()
    {
        return view('obat-obatan/obat-obatan_add', [
            'title' => 'Form Tambah Data Obat-Obatan',
            'navLink' => 'obat-obatan',
            'accessRight' => $this->accessRights
        ]);
    }

    public function obatEdit($id)
    {
        $getObatById = $this->obatModel->find($id);

        return view('obat-obatan/obat-obatan_edit', [
            'title' => 'Form Ubah Data Obat-Obatan',
            'navLink' => 'obat-obatan',
            'getObat' => $getObatById,
            'accessRight' => $this->accessRights
        ]);
    }

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
