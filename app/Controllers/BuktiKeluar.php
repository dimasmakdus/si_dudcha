<?php

namespace App\Controllers;

class BuktiKeluar extends BaseController
{
    public function cetakLBBK()
    {
        $getBarangKeluar =  $this->pengeluaranModel->findAll();

        $bulanIni =  $this->tgl_indo(date('Y-m'));
        $bulanDepan =  $this->tgl_indo(date('Y-m', strtotime(date('Y-m') . " +1 month")));

        return view('barang-keluar/cetak-lbbk', [
            'title' => 'Cetak Laporan Bukti Barang Keluar',
            'getBarangKeluar' => $getBarangKeluar,
            'bulanIni' => $bulanIni,
            'bulanDepan' => $bulanDepan
        ]);
    }
}
