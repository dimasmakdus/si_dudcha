<?php

namespace App\Controllers;

class Supplier extends BaseController
{
    // Halaman edit supplier
    public function supplierEdit($id)
    {
        $getSupplierById = $this->supplierModel->find($id);

        return view('supplier/supplier_edit', [
            'title' => 'Form Ubah Data supplier',
            'navLink' => 'supplier',
            'getSupplier' => $getSupplierById,
            'accessRight' => $this->accessRights
        ]);
    }

    // CRUD 
    public function create()
    {
        $this->supplierModel->insert($this->request->getVar());
        return redirect()->to('supplier')->with('success', 'Data Supplier Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('kode_supplier');
        $this->supplierModel->update($id, $this->request->getVar());
        return redirect()->to('supplier')->with('success', 'Data Supplier Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->supplierModel->delete($id);
        return redirect()->to('supplier')->with('success', 'Data Supplier Berhasil Dihapus');
    }
}
