<?php

namespace App\Controllers;

use DateTime;

class PenjualanBarang extends BaseController
{
    // Cetak Laporan Nota Penjualan
    public function cetakNota($id)
    {
        $penjualan = $this->penjualanBarangModel->find($id);
        $penjualanDetail = $this->penjualanBarangDetailModel
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_penjualan_barang_detail.satuan', 'left')
            ->findAll();

        foreach ($penjualanDetail as $detail) {
            if ($penjualan['id_transaksi'] == $detail['id_transaksi']) {
                $detailBarang[] = $detail;
            }
        }

        return view('laporan/cetak-nota', [
            'title' => 'Cetak Nota',
            'titleHeader' => $this->titleHeader,
            'penjualan' => $penjualan,
            'detailBarang' => $detailBarang,
        ]);
    }

    // Transaksi Penjualan Barang
    public function create()
    {
        $id_outlet = $this->request->getVar('outlet_id');
        $kode_barang = $this->request->getVar('kode_barang');
        $nama_barang = $this->request->getVar('nama_barang');
        $sales = $this->request->getVar('sales');
        $harga_jual = $this->request->getVar('harga_jual');
        $satuan = $this->request->getVar('satuan');
        $jumlah = $this->request->getVar('jumlah');

        $tgl = date("Y-m-d H:i:s");

        $tmb_trans = $this->penjualanBarangModel->orderBy('id_transaksi', 'ASC')->findAll();
        if ($tmb_trans != []) {
            foreach ($tmb_trans as $trans) {
                $lastId = $trans['id_transaksi'];
            }
            $nomor_nota = "DCH" . date("Y") . date("m") . sprintf("%05d", $lastId + 1);
        } else {
            $nomor_nota = "DCH" . date("Y") . date("m") . sprintf("%05d", 1);
        }

        if ($tmb_trans != array()) {
            foreach ($tmb_trans as $trans) {
                $nomor_db = $trans['id_transaksi'] + 1;
            }
        } else {
            $nomor_db = 1;
        }

        if (isset($kode_barang)) {
            $checked = false;
        } else {
            $checked = true;
            echo "empty_barang";
            die;
        }

        if (!$checked) {
            $data_outlet = $this->outletModel->find($id_outlet);

            $totalBarang = 0;
            for ($j = 0; $j < count($kode_barang); $j++) {
                $totalBarang = $totalBarang + ($jumlah[$j] * $harga_jual[$j]);
            }

            $this->penjualanBarangModel->insert([
                'id_transaksi' => $nomor_db,
                'no_nota' => $nomor_nota,
                'outlet_id' => $data_outlet['outlet_id'],
                'outlet_name' => $data_outlet['outlet_name'],
                'outlet_alamat' => $data_outlet['outlet_alamat'],
                'sales' => $sales,
                'tanggal' => $tgl,
                'total' => $totalBarang
            ]);

            for ($i = 0; $i < count($kode_barang); $i++) {
                $this->penjualanBarangDetailModel->insert([
                    'id_transaksi' => $nomor_db,
                    'kode_barang' => $kode_barang[$i],
                    'nama_barang' => $nama_barang[$i],
                    'jumlah' => $jumlah[$i],
                    'satuan' => $satuan[$i],
                    'harga_jual' => $harga_jual[$i],
                ]);

                $barang = $this->barangModel->find($kode_barang[$i]);
                $stok_akhir = $barang['stok'] - $jumlah[$i];

                // barang keluar
                $this->stokBarangModel->insert([
                    'kode_barang' => $kode_barang[$i],
                    'tanggal' => $tgl,
                    'stok_awal' => $barang['stok'],
                    'stok_keluar' => $jumlah[$i],
                    'stok_akhir' => $stok_akhir
                ]);

                // pengurangan sisa stok
                $this->barangModel->update($kode_barang[$i], [
                    'nama_barang' => $nama_barang[$i],
                    'stok' => $stok_akhir,
                    'satuan' => $satuan[$i]
                ]);
            }
            $this->sendNotification(2, session()->get('name'), 'Telah Bertransaksi Penjualan Barang', '/barang-masuk');
            redirect()->with('success', 'Transaksi Penjualan barang berhasil');
            echo "success";
        } else {
            echo "empty_barang";
            die;
        }
    }
}
