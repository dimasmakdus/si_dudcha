<?php

namespace App\Controllers;

class Supplier extends BaseController
{
    public function supplierAdd()
    {
        return view('supplier/supplier_add', [
            'title' => 'Form Tambah Data Supplier',
            'navLink' => 'supplier',
            'accessRight' => $this->accessRights
        ]);
    }

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
