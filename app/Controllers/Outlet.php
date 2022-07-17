<?php

namespace App\Controllers;

class Outlet extends BaseController
{
    public function create()
    {
        $this->outletModel->insert($this->request->getVar());
        return redirect()->to('outlet')->with('success', 'Data Outlet Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('outlet_id');
        $this->outletModel->update($id, $this->request->getVar());
        return redirect()->to('outlet')->with('success', 'Data Outlet Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->outletModel->delete($id);
        return redirect()->to('outlet')->with('success', 'Data Outlet Berhasil Dihapus');
    }
}
