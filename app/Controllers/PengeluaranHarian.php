<?php

namespace App\Controllers;

class PengeluaranHarian extends BaseController
{
    function noPengeluaranOtomatis()
    {
        $db = \Config\Database::connect();
        $today = date('d-m-Y');

        // mencari kode barang dengan nilai paling besar
        $query = "SELECT max(id_pengeluaran) as maxPengeluaran FROM tbl_pengeluaran_barang where tgl_serah_barang = '$today'";
        $data = $db->query($query)->getRowArray();

        $kode = $data['maxPengeluaran'];
        $noUrut = (int) substr($kode, 0, 4);
        $noUrut++;
        $kodeBaru = sprintf("%04s", $noUrut); //sprintf berfungsi untuk menampilkan kodebaru yang diambil
        //berdasarkan no_urut, "%04s" berfungsi untuk menampilkan berapa karakter yang ingin ditampilkan kalau %04s berarti yang ditampilkan hanya 4 karakter
        return $kodeBaru;
    }

    public function pengeluaranAdd()
    {
        return view('pengeluaranHarian/pengeluaran_add', [
            'title' => 'Form Tambah Data Pengeluaran Harian',
            'navLink' => 'pengeluaran-harian',
            'accessRight' => $this->accessRights,
            'kodeBarang' => $this->barangModel->findAll(),
            'getPasien' => $this->pasienModel->findAll(),
            'no_terima_barang' => "S-" . date('ymd') . "-" . $this->noPengeluaranOtomatis()
        ]);
    }

    public function cetakLPHO()
    {
        $getPengeluaran = $this->pengeluaranModel->findAll();

        $bulanIni =  $this->tgl_indo(date('Y-m'));
        $bulanDepan =  $this->tgl_indo(date('Y-m', strtotime(date('Y-m') . " +1 month")));

        return view('pengeluaranHarian/cetak_lpho', [
            'title' => 'Cetak Laporan Pengeluaran Harian',
            'getPengeluaran' => $getPengeluaran,
            'bulanIni' => $bulanIni,
            'bulanDepan' => $bulanDepan
        ]);
    }

    public function create()
    {
        $post = $this->request->getVar();
        $no_rekamedis = $post['no_rekamedis'];
        $kode_barang = $post['kode-stok-barang'];

        $getPasien = $this->pasienModel->find($no_rekamedis);
        $getBarang = $this->barangModel->find($kode_barang);

        $this->pengeluaranModel->insert([
            'id_pengeluaran' => $this->noPengeluaranOtomatis(),
            'no_terima_barang' => $post['no_terima_barang'],
            'nama_pasien' => $getPasien['nama_pasien'],
            'kode_barang' => $getBarang['kode_barang'],
            'nama_barang' => $getBarang['nama_barang'],
            'jenis_barang' => $getBarang['jenis_barang'],
            'dosis_aturan_barang' => $getBarang['dosis_aturan_barang'],
            'jumlah' => $post['jumlah'],
            'satuan' => $getBarang['satuan'],
            'keterangan' => $post['keterangan'],
            'tgl_serah_barang' => date('d-m-Y')

        ]);
        return redirect()->to('pengeluaran-harian')->with('success', 'Data Pengeluaran Harian Berhasil Ditambahkan');
    }

    public function remove($id)
    {
        $this->pengeluaranModel->delete($id);
        return redirect()->to('pengeluaran-harian')->with('success', 'Data Pengeluaran Harian Berhasil Dihapus');
    }
}
