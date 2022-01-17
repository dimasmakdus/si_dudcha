<?php

namespace App\Controllers;

class BarangMasuk extends BaseController
{
    function barang_masuk_add()
    {
        $pesanan = $this->permintaanModel->orderBy('tanggal', 'DESC')->findAll();
        foreach ($pesanan as $data) {
            if ($data['status'] == 'approved' && $data['proses'] == '0') {
                $supplier = $this->supplierModel->find($data['kode_supplier']);
                $permintaan[] = [
                    'no_pesanan' => $data['kode_pesanan'],
                    'supplier' => $supplier['nama_supplier']
                ];

                foreach ($this->permintaanDetailModel->findAll() as $detail) {
                    if ($data['id'] == $detail['id_permintaan']) {
                        $obat = $this->obatModel->find($detail['kode_obat']);

                        $detail_obat[] = [
                            'no_pesanan' => $data['kode_pesanan'],
                            'kode_obat' => $obat['kode_obat'],
                            'nama_obat' => $obat['nama_obat'],
                            'satuan' => $obat['satuan'],
                            'stok' => $detail['stok'],
                        ];
                    }
                }
            }
        }

        return view('barang/barang_masuk_add', [
            'title' => 'Tambah Stok Obat',
            'card_title' => 'Tambah Stok Obat',
            'navLink' => 'barang-masuk',
            'pesanan' => $pesanan,
            'supplier' => $this->supplierModel,
            'permintaan' => $permintaan,
            'detail_obat' => $detail_obat,
            'reqGet' => $this->request->getGet()
        ]);
    }
}
