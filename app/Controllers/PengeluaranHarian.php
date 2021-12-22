<?php

namespace App\Controllers;

class PengeluaranHarian extends BaseController
{
    function noPengeluaranOtomatis()
    {
        $db = \Config\Database::connect();
        $today = date('d-m-Y');

        // mencari kode barang dengan nilai paling besar
        $query = "SELECT max(id_pengeluaran) as maxPengeluaran FROM tbl_pengeluaran_obat where tgl_serah_obat = '$today'";
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
            'kodeObat' => $this->obatModel->findAll(),
            'getPasien' => $this->pasienModel->findAll(),
            'no_terima_obat' => "S-" . date('ymd') . "-" . $this->noPengeluaranOtomatis()
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
        $kode_obat = $post['kode-stok-obat'];

        $getPasien = $this->pasienModel->find($no_rekamedis);
        $getObat = $this->obatModel->find($kode_obat);

        $this->pengeluaranModel->insert([
            'id_pengeluaran' => $this->noPengeluaranOtomatis(),
            'no_terima_obat' => $post['no_terima_obat'],
            'nama_pasien' => $getPasien['nama_pasien'],
            'kode_obat' => $getObat['kode_obat'],
            'nama_obat' => $getObat['nama_obat'],
            'jenis_obat' => $getObat['jenis_obat'],
            'dosis_aturan_obat' => $getObat['dosis_aturan_obat'],
            'jumlah' => $post['jumlah'],
            'satuan' => $getObat['satuan'],
            'keterangan' => $post['keterangan'],
            'tgl_serah_obat' => date('d-m-Y')

        ]);
        return redirect()->to('pengeluaran-harian')->with('success', 'Data Pengeluaran Harian Berhasil Ditambahkan');
    }

    public function remove($id)
    {
        $this->pengeluaranModel->delete($id);
        return redirect()->to('pengeluaran-harian')->with('success', 'Data Pengeluaran Harian Berhasil Dihapus');
    }
}
