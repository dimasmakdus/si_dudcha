<?php

namespace App\Controllers;

class Supplier extends BaseController
{
    public function supplierAdd()
    {
        return view('supplier/supplier_add', [
            'title' => 'Form Tambah Data Supplier',
            'navLink' => 'supplier'
        ]);
    }

    public function supplierEdit($id)
    {
        $getSupplierById = $this->supplierModel->find($id);

        return view('supplier/supplier_edit', [
            'title' => 'Form Ubah Data supplier',
            'navLink' => 'supplier',
            'getSupplier' => $getSupplierById
        ]);
    }
}
