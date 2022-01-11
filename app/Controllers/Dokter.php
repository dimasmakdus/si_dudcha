<?php

namespace App\Controllers;

class Dokter extends BaseController
{
    public function create()
    {
        $this->dokterModel->insert($this->request->getVar());
        return redirect()->to('data-dokter')->with('success', 'Data Dokter Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $this->dokterModel->update($id, $this->request->getVar());
        return redirect()->to('data-dokter')->with('success', 'Data Dokter Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->dokterModel->delete($id);
        return redirect()->to('data-dokter')->with('success', 'Data Dokter Berhasil Dihapus');
    }
}
