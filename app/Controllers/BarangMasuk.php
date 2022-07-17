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

                $detail_pesanan = $this->permintaanDetailModel
                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_permintaan_detail.satuan_barang_id', 'left')
                    ->findAll();
                foreach ($detail_pesanan as $detail) {
                    if ($data['id'] == $detail['id_permintaan']) {
                        $barang = $this->barangModel
                            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                            ->find($detail['kode_barang']);

                        $detail_barang[] = [
                            'no_pesanan' => $data['kode_pesanan'],
                            'kode_barang' => $barang['kode_barang'],
                            'nama_barang' => $barang['nama_barang'],
                            'harga_beli' => $detail['harga_beli'],
                            'satuan' => $detail['satuan_barang_name'],
                            'satuan_id' => $detail['satuan_barang_id'],
                            'stok' => $detail['stok'],
                            'satuan_digudang' => $barang['satuan_barang_name'],
                            'nilai_satuan' => $barang['nilai_satuan'],
                        ];
                    }
                }
            }
        }

        $satuan_barang = $this->satuanBarangModel->findAll();

        return view('barang/barang_masuk_add', [
            'title' => 'Pengemasan Barang',
            'card_title' => 'Pengemasan Barang',
            'navLink' => 'pengemasan-barang',
            'pesanan' => $pesanan,
            'supplier' => $this->supplierModel,
            'permintaan' => isset($permintaan) ? $permintaan : [],
            'satuan_barang' => isset($satuan_barang) ? $satuan_barang : [],
            'detail_barang' => isset($detail_barang) ? $detail_barang : [],
            'reqGet' => $this->request->getGet()
        ]);
    }

    function create()
    {
        $no_faktur = $this->request->getVar('no_faktur');
        $data_pesanan = $this->request->getVar('data_pesanan');
        $kode_supplier = $this->request->getVar('kode_supplier');
        $kode_barang = $this->request->getVar('kode_barang');
        $stok_pemesanan = $this->request->getVar('stok');
        $stok_masuk = $this->request->getVar('stokMasuk');
        $tgl_kd = $this->request->getVar('tgl_kd');
        $harga_pemesanan = $this->request->getVar('harga_pemesanan');
        $satuan_pemesanan = $this->request->getVar('satuan_pemesanan');
        $harga_beli = $this->request->getVar('harga_beli');
        $tanggal = date("Y-m-d H:i:s");

        // cek stok < stok_masuk
        // $cekStok = false;
        // for ($i = 0; $i < count($kode_barang); $i++) {
        //     if ($stok[$i] < $stok_masuk[$i]) {
        //         $cekStok = true;
        //         echo "over_stok";
        //         die;
        //     }
        // }

        // cek input qty != kosong
        $checked = false;
        foreach ($stok_masuk as $value) {
            if ($value == "" || $value <= 0) {
                $checked = true;
                echo "empty_qty";
                die;
            }
        }

        // total harga barang
        $totalHarga = 0;
        for ($i = 0; $i < count($kode_barang); $i++) {
            $totalHarga = $totalHarga + ($stok_pemesanan[$i] * $harga_beli[$i]);
        }

        // if (!$checked && !$cekStok) {
        if (!$checked) {
            $this->pembelianModel->insert([
                'faktur' => $no_faktur,
                'kode_pemesanan' => $data_pesanan,
                'tanggal' => $tanggal,
                'total' => $totalHarga,
                'kode_supplier' => $kode_supplier,
                'status_pembayaran' => 'false'
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

            for ($i = 0; $i < count($kode_barang); $i++) {
                $this->pembelianDetailModel->insert([
                    'id_pembelian' => $row['id'],
                    'kode_barang' => $kode_barang[$i],
                    'stok_masuk' => $stok_masuk[$i],
                    'harga_beli' => $harga_beli[$i],
                    'satuan_barang_id' => $satuan_pemesanan[$i],
                    'stok_pemesanan' => $stok_pemesanan[$i],
                    'harga_pemesanan' => $harga_pemesanan[$i],
                ]);

                $barang = $this->barangModel->find($kode_barang[$i]);
                $stok_akhir = $barang['stok'] + $stok_masuk[$i];

                // barang masuk
                $this->stokBarangModel->insert([
                    'kode_barang' => $kode_barang[$i],
                    'tanggal' => $tanggal,
                    'stok_awal' => $barang['stok'],
                    'stok_masuk' => $stok_masuk[$i],
                    'stok_akhir' => $stok_akhir,
                    // 'tgl_kadaluarsa' => $tgl_kd[$i]
                ]);

                // penambahan sisa stok
                $this->barangModel->update($kode_barang[$i], [
                    'nama_barang' => $barang['nama_barang'],
                    'stok' => $stok_akhir,
                    'harga_beli' => $harga_beli[$i],
                ]);
            }

            $this->sendNotification(2, session()->get('name'), 'Stok Barang telah di tambahkan', '/barang-masuk');
            echo "success";
        } else {
            echo "empty_qty";
            die;
        }
    }

    function updatePembayaran($id)
    {
        $status = $this->request->getVar('status_pembayaran');

        try {
            $this->pembelianModel->update($id, [
                'status_pembayaran' => $status
            ]);

            echo 'success';
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    function cetakKuitansi()
    {
        $beli = $this->pembelianModel->find($_GET['id_pembeli']);

        return view('laporan/cetak-kuitansi', [
            'kode_pemesanan' => $beli['kode_pemesanan'],
            'tanggal' => $beli['tanggal'],
            'tanggalWithBulan' => $this->tanggal(date("Y-m-d", strtotime($beli['tanggal']))),
            'id_pembeli' => $_GET['id_pembeli'],
            'diterima' => $_GET['diterima'],
            'jumlah_uang_terbilang' => $this->terbilang($_GET['jumlah_uang']),
            'pembayaran' => $_GET['pembayaran'],
            'bagian_keuangan' => $_GET['bagian_keuangan'],
            'supplier' => $_GET['supplier'],
        ]);
    }
}
