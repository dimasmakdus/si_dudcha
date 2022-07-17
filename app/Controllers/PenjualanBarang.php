<?php

namespace App\Controllers;

use DateTime;

class PenjualanBarang extends BaseController
{
    public function resepAdd()
    {
        $data_resep = $this->resepModel->orderBy('id_transaksi', 'ASC')->findAll();
        foreach ($data_resep as $maxId) {
        }
        return view('resep/resep_add', [
            'title' => 'Tambah Salinan Resep',
            'card_title' => 'Tambah Salinan Resep',
            'navLink' => 'resep-barang',
            'resep_pasien' => $this->pasienModel->orderBy('no_resep', 'ASC')->findAll(),
            'barang_barangan' => $this->barangModel->orderBy('kode_barang', 'ASC')->findAll(),
            'aturan_barang' => $this->aturanModel->orderBy('dosis_aturan_barang', 'DESC')->findAll(),
            'maxId' => $data_resep != [] ? $maxId['id_transaksi'] : 0
        ]);
    }

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
            'penjualan' => $penjualan,
            'detailBarang' => $detailBarang,
        ]);
    }

    // Pengambilan Barang
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
            redirect()->with('success', 'Data Pengambilan barang berhasil di tambahkan');
            echo "success";
        } else {
            echo "empty_barang";
            die;
        }
    }

    // Tambah Salinan Resep
    public function postSalinanResep()
    {
        $no_resep = $this->request->getVar('no_resep');
        $kode_barang = $this->request->getVar('kode_barang');
        $nama_barang = $this->request->getVar('nama_barang');
        $satuan = $this->request->getVar('satuan');
        $jumlah = $this->request->getVar('jumlah');
        $dosis_aturan_barang = $this->request->getVar('dosis_aturan');
        $tgl = date("Y-m-d H:i:s");

        $tmb_trans = $this->resepModel->orderBy('id_transaksi', 'ASC')->findAll();
        if ($tmb_trans != array()) {
            foreach ($tmb_trans as $trans) {
                $nomor_db = $trans['id_transaksi'] + 1;
            }
        } else {
            $nomor_db = 1;
        }

        $dosis = $dosis_aturan_barang != null ? $dosis_aturan_barang : [];
        $checked = false;
        if ($dosis != []) {
            foreach ($dosis as $value) {
                if ($value == "") {
                    $checked = true;
                    echo "empty_dosis";
                    die;
                }
            }
        } else {
            $checked = true;
            echo "empty_barang";
            die;
        }

        if (!$checked) {
            $resep_pasien = $this->pasienModel->find($no_resep);

            $totalResep = 0;
            for ($j = 0; $j < count($kode_barang); $j++) {
                $totalResep = $totalResep + $jumlah[$j];
            }

            $this->resepModel->insert([
                'id_transaksi' => $nomor_db,
                'kode_resep' => $resep_pasien['no_resep'],
                'status_pasien' => $resep_pasien['status_pasien'],
                'nama_pasien' => $resep_pasien['nama_pasien'],
                'umur' => $resep_pasien['umur'],
                'alamat' => $resep_pasien['alamat'],
                'tanggal' => $tgl,
                'nama_dokter' => $resep_pasien['nama_dokter'],
                'total' => $totalResep
            ]);

            for ($i = 0; $i < count($kode_barang); $i++) {
                $this->resepDetailModel->insert([
                    'id_transaksi' => $nomor_db,
                    'kode_barang' => $kode_barang[$i],
                    'nama_barang' => $nama_barang[$i],
                    'jumlah' => $jumlah[$i],
                    'satuan' => $satuan[$i],
                    'dosis_aturan_barang' => $dosis_aturan_barang[$i]
                ]);
            }
            redirect()->with('success', 'Salinan Resep berhasil di tambahkan');
            echo "success";
        } else {
            echo "empty_dosis";
            die;
        }
    }

    public function remove($id)
    {
        $this->resepModel->delete($id);
        return redirect()->to('resep-barang')->with('success', 'Data Resep Berhasil Dihapus');
    }
}
