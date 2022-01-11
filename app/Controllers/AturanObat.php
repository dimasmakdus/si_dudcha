<?php

namespace App\Controllers;

class AturanObat extends BaseController
{
    public function create()
    {
        $this->aturanModel->insert($this->request->getVar());
        return redirect()->to('aturan-obat')->with('success', 'Data Aturan Obat Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $this->aturanModel->update($id, $this->request->getVar());
        return redirect()->to('aturan-obat')->with('success', 'Data Aturan Obat Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->aturanModel->delete($id);
        return redirect()->to('aturan-obat')->with('success', 'Data Aturan Obat Berhasil Dihapus');
    }
}
