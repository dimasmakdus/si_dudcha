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
                    'supplier' => $supplier['kode_supplier']
                ];

                $i = 1;
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
            'permintaan' => isset($permintaan) ? $permintaan : [],
            'detail_obat' => isset($detail_obat) ? $detail_obat : [],
            'reqGet' => $this->request->getGet()
        ]);
    }

    function create()
    {
        $no_faktur = $this->request->getVar('no_faktur');
        $data_pesanan = $this->request->getVar('data_pesanan');
        $kode_supplier = $this->request->getVar('kode_supplier');
        $kode_obat = $this->request->getVar('kode_obat');
        $stok = $this->request->getVar('stok');
        $stok_masuk = $this->request->getVar('stokMasuk');
        $tgl_kd = $this->request->getVar('tgl_kd');
        $tanggal = date("Y-m-d H:i:s");

        // cek stok < stok_masuk
        $cekStok = false;
        for ($i = 0; $i < count($kode_obat); $i++) {
            if ($stok[$i] < $stok_masuk[$i]) {
                $cekStok = true;
                echo "over_stok";
                die;
            }
        }

        // cek input qty != kosong
        $checked = false;
        foreach ($stok_masuk as $value) {
            if ($value == "" || $value <= 0) {
                $checked = true;
                echo "empty_qty";
                die;
            }
        }

        // total obat
        $totalObat = 0;
        foreach ($stok_masuk as $stok) {
            $totalObat = $totalObat + $stok;
        }

        if (!$checked && !$cekStok) {
            $this->pembelianModel->insert([
                'faktur' => $no_faktur,
                'kode_pemesanan' => $data_pesanan,
                'tanggal' => $tanggal,
                'total' => $totalObat,
                'kode_supplier' => $kode_supplier
            ]);

            foreach ($this->permintaanModel->findAll() as $pesanan) {
                if ($pesanan['kode_pesanan'] == $data_pesanan) {
                    $this->permintaanModel->update($pesanan['id'], [
                        'proses' => 1
                    ]);
                }
            }

            foreach ($this->pembelianModel->orderBy('id', 'ASC')->findAll() as $row) {
            }

            for ($i = 0; $i < count($kode_obat); $i++) {
                $this->pembelianDetailModel->insert([
                    'id_pembelian' => $row['id'],
                    'kode_obat' => $kode_obat[$i],
                    'stok_masuk' => $stok_masuk[$i],
                    'tgl_kadaluarsa' => $tgl_kd[$i]
                ]);

                $obat = $this->obatModel->find($kode_obat[$i]);
                $stok_akhir = $obat['stok'] + $stok_masuk[$i];

                // barang masuk
                $this->stokObatModel->insert([
                    'kode_obat' => $kode_obat[$i],
                    'tanggal' => $tanggal,
                    'stok_awal' => $obat['stok'],
                    'stok_masuk' => $stok_masuk[$i],
                    'stok_akhir' => $stok_akhir,
                    'tgl_kadaluarsa' => $tgl_kd[$i]
                ]);

                // penambahan sisa stok
                $this->obatModel->update($kode_obat[$i], [
                    'nama_obat' => $obat['nama_obat'],
                    'stok' => $stok_akhir,
                    'satuan' => $obat['satuan'],
                    'tgl_kadaluarsa' => $tgl_kd[$i]
                ]);
            }
            echo "success";
        } else {
            echo "empty_qty";
            die;
        }
    }
}
