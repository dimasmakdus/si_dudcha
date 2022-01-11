<?php

namespace App\Controllers;

class Pasien extends BaseController
{
    public function create()
    {
        $this->pasienModel->insert($this->request->getVar());
        return redirect()->to('resep-pasien')->with('success', 'Data Resep Pasien Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('no_resep');
        $this->pasienModel->update($id, $this->request->getVar());
        return redirect()->to('resep-pasien')->with('success', 'Data Resep Pasien Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->pasienModel->delete($id);
        return redirect()->to('resep-pasien')->with('success', 'Data Resep Pasien Berhasil Dihapus');
    }
}
