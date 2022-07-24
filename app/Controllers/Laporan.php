<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    // GET Laporan Persediaan Barang
    function laporan_stok_barang()
    {
        $reqGet = $this->request->getGet();
        if (isset($reqGet['periode']) && $this->stokBarangModel->findAll() != []) {
            foreach ($this->stokBarangModel->findAll() as $stok) {
                $to_barang = $this->barangModel
                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                    ->find($stok['kode_barang']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date >= $reqGet['start_date'] && $date <= $reqGet['end_date']) {
                    $getPeriode[] = [
                        'kode_barang' => isset($to_barang) ? $to_barang['kode_barang'] : '',
                        'nama_barang' => isset($to_barang) ? $to_barang['nama_barang'] : '',
                        'satuan' => isset($to_barang) ? $to_barang['satuan_barang_name'] : '',
                        'stok_awal' => $stok['stok_awal'] != null ? $stok['stok_awal'] : 0,
                        'stok_masuk' => $stok['stok_masuk'] != null ? $stok['stok_masuk'] : 0,
                        'stok_keluar' => $stok['stok_keluar'] != null ? $stok['stok_keluar'] : 0,
                        'stok_akhir' => $stok['stok_akhir'] != null ? $stok['stok_akhir'] : 0
                    ];
                } else {
                    $getPeriode = [];
                }
            }
        } else if (isset($reqGet['day']) && $this->stokBarangModel->findAll() != []) {
            foreach ($this->stokBarangModel->findAll() as $stok) {
                $to_barang = $this->barangModel
                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                    ->find($stok['kode_barang']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date == $reqGet['date']) {
                    $getPeriode[] = [
                        'kode_barang' => isset($to_barang) ? $to_barang['kode_barang'] : '',
                        'nama_barang' => isset($to_barang) ? $to_barang['nama_barang'] : '',
                        'satuan' => isset($to_barang) ? $to_barang['satuan_barang_name'] : '',
                        'stok_awal' => $stok['stok_awal'] != null ? $stok['stok_awal'] : 0,
                        'stok_masuk' => $stok['stok_masuk'] != null ? $stok['stok_masuk'] : 0,
                        'stok_keluar' => $stok['stok_keluar'] != null ? $stok['stok_keluar'] : 0,
                        'stok_akhir' => $stok['stok_akhir'] != null ? $stok['stok_akhir'] : 0,
                    ];
                } else {
                    $getPeriode = [];
                }
            }
        } else {
            $getPeriode = [];
        }

        $totalAwal = 0;
        $totalMasuk = 0;
        $totalKeluar = 0;
        $totalAkhir = 0;
        foreach ($getPeriode as $row) {
            $totalAwal = $totalAwal + $row['stok_awal'];
            $totalMasuk = $totalMasuk + $row['stok_masuk'];
            $totalKeluar = $totalKeluar + $row['stok_keluar'];
            $totalAkhir = $totalAkhir + $row['stok_akhir'];
        }

        $total = [
            'awal' => $totalAwal,
            'masuk' => $totalMasuk,
            'keluar' => $totalKeluar,
            'akhir' => $totalAkhir

        ];

        return view('laporan/laporan_stok_barang', [
            'title' => 'Laporan Persediaan Barang',
            'card_title' => 'Laporan Persediaan Barang',
            'navLink' => 'laporan-stok-barang',
            'titleHeader' => $this->titleHeader,
            'perTanggal' => (isset($reqGet['date'])) ? $this->tanggal($reqGet['date']) : '',
            'today' => $this->tanggal(date('Y-m-d')),
            'reqGet' => $reqGet,
            'getPeriode' => $getPeriode,
            'total' => $total
        ]);
    }

    // Cetak Laporan Persediaan Barang
    function cetak_lpo()
    {
        $reqGet = $this->request->getGet();
        if (isset($reqGet['periode']) && $this->stokBarangModel->findAll() != []) {
            foreach ($this->stokBarangModel->findAll() as $stok) {
                $to_barang = $this->barangModel
                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                    ->find($stok['kode_barang']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date >= $reqGet['start_date'] && $date <= $reqGet['end_date']) {
                    $getPeriode[] = [
                        'kode_barang' => isset($to_barang) ? $to_barang['kode_barang'] : '',
                        'nama_barang' => isset($to_barang) ? $to_barang['nama_barang'] : '',
                        'satuan' => isset($to_barang) ? $to_barang['satuan_barang_name'] : '',
                        'stok_awal' => $stok['stok_awal'] != null ? $stok['stok_awal'] : 0,
                        'stok_masuk' => $stok['stok_masuk'] != null ? $stok['stok_masuk'] : 0,
                        'stok_keluar' => $stok['stok_keluar'] != null ? $stok['stok_keluar'] : 0,
                        'stok_akhir' => $stok['stok_akhir'] != null ? $stok['stok_akhir'] : 0,
                    ];
                } else {
                    $getPeriode = [];
                }
            }
        } else if (isset($reqGet['day']) && $this->stokBarangModel->findAll() != []) {
            foreach ($this->stokBarangModel->findAll() as $stok) {
                $to_barang = $this->barangModel
                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                    ->find($stok['kode_barang']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date == $reqGet['date']) {
                    $getPeriode[] = [
                        'kode_barang' => isset($to_barang) ? $to_barang['kode_barang'] : '',
                        'nama_barang' => isset($to_barang) ? $to_barang['nama_barang'] : '',
                        'satuan' => isset($to_barang) ? $to_barang['satuan_barang_name'] : '',
                        'stok_awal' => $stok['stok_awal'] != null ? $stok['stok_awal'] : 0,
                        'stok_masuk' => $stok['stok_masuk'] != null ? $stok['stok_masuk'] : 0,
                        'stok_keluar' => $stok['stok_keluar'] != null ? $stok['stok_keluar'] : 0,
                        'stok_akhir' => $stok['stok_akhir'] != null ? $stok['stok_akhir'] : 0,
                    ];
                } else {
                    $getPeriode = [];
                }
            }
        } else {
            $getPeriode = [];
        }

        $totalAwal = 0;
        $totalMasuk = 0;
        $totalKeluar = 0;
        $totalAkhir = 0;
        foreach ($getPeriode as $row) {
            $totalAwal = $totalAwal + $row['stok_awal'];
            $totalMasuk = $totalMasuk + $row['stok_masuk'];
            $totalKeluar = $totalKeluar + $row['stok_keluar'];
            $totalAkhir = $totalAkhir + $row['stok_akhir'];
        }

        $total = [
            'awal' => $totalAwal,
            'masuk' => $totalMasuk,
            'keluar' => $totalKeluar,
            'akhir' => $totalAkhir
        ];

        return view('laporan/cetak-lpo', [
            'titleHeader' => $this->titleHeader,
            'reqGet' => $reqGet,
            'getPeriode' => $getPeriode,
            'perTanggal' => (isset($reqGet['date'])) ? $this->tanggal($reqGet['date']) : '',
            'today' => $this->tanggal(date('Y-m-d')),
            'total' => $total
        ]);
    }

    // GET Laporan Barang Masuk
    function laporan_masuk()
    {
        return view('laporan/laporan_masuk', [
            'title' => 'Laporan Pemasukan',
            'card_title' => 'Laporan Pemasukan',
            'navLink' => 'laporan-masuk',
            'titleHeader' => $this->titleHeader,
            'db' => $this->db,
            'reqGet' => $this->request->getGet()
        ]);
    }

    // Cetak Laporan Barang Masuk
    function cetak_lbm()
    {
        return view('laporan/cetak-lbm', [
            'titleHeader' => $this->titleHeader,
            'db' => $this->db,
            'reqGet' => $this->request->getGet(),
            'today' => $this->tanggal(date('Y-m-d'))
        ]);
    }

    // GET Laporan Barang Keluar
    function laporan_keluar()
    {
        return view('laporan/laporan_keluar', [
            'title' => 'Laporan Pengeluaran',
            'card_title' => 'Laporan Pengeluaran',
            'navLink' => 'laporan-keluar',
            'titleHeader' => $this->titleHeader,
            'db' => $this->db,
            'today' => $this->tanggal(date('Y-m-d')),
            'reqGet' => $this->request->getGet()
        ]);
    }

    // Cetak Laporan Barang Keluar
    function cetak_lbk()
    {
        return view('laporan/cetak-lbk', [
            'titleHeader' => $this->titleHeader,
            'db' => $this->db,
            'reqGet' => $this->request->getGet(),
            'today' => $this->tanggal(date('Y-m-d'))
        ]);
    }

    // Laporan Pengajuan/Permintaan
    // function laporan_permintaan()
    // {
    //     return view('laporan/laporan_permintaan', [
    //         'title' => 'Laporan Permintaan',
    //         'card_title' => 'Laporan Permintaan',
    //         'navLink' => 'laporan-permintaan',
    //         'reqGet' => $this->request->getGet(),
    //         'today' => $this->tanggal(date('Y-m-d')),
    //         'db' => $this->db
    //     ]);
    // }

    function cetakPesanan($id)
    {
        $pesanan = $this->permintaanModel->find($id);
        $pesanan_detail = $this->permintaanDetailModel
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_permintaan_detail.satuan_barang_id', 'left')
            ->where('id_permintaan', $id)
            ->findAll();

        $supplier = $this->supplierModel->find($pesanan['kode_supplier']);
        $laporan = [
            'kode_pesanan' => $pesanan['kode_pesanan'],
            'tanggal' => $pesanan['tanggal'],
            'supplier' => $supplier['nama_supplier']
        ];

        return view('laporan/cetak-pesanan', [
            'titleHeader' => $this->titleHeader,
            'data_pesanan' => $pesanan_detail,
            'pesanan' => $pesanan,
            'laporan' => $laporan,
            'today' => $this->tanggal(date('Y-m-d'))
        ]);
    }

    // function cetak_lpb()
    // {
    //     return view('laporan/cetak-lpb', [
    //         'db' => $this->db,
    //         'reqGet' => $this->request->getGet(),
    //         'today' => $this->tanggal(date('Y-m-d'))
    //     ]);
    // }
    // function cetak_permintaan()
    // {
    //     $req = $this->reqPermintaan($this->request->getGet());
    //     $active = $req['active'];
    //     $data_pesanan = $req['data_pesanan'];
    //     $kode_doc = $req['kode_doc'];
    //     $subTotal = $req['subTotal'];

    //     return view('laporan/cetak-pesanan', [
    //         'reqGet' => $this->request->getGet(),
    //         'today' => $this->tanggal(date('Y-m-d')),
    //         'subTotal' => $active ? $subTotal : [],
    //         'data_pesanan' => $active ? $data_pesanan : [],
    //         'laporan' => $active ? $kode_doc : []
    //     ]);
    // }

    // function reqPermintaan($reqGet)
    // {
    //     $active = false;
    //     if (isset($reqGet['report'])) {
    //         $start_date = $reqGet['start_date'];
    //         $end_date = $reqGet['end_date'];

    //         foreach ($this->permintaanDetailModel->findAll() as $row) {
    //             $data = $this->permintaanModel->find($row['id_permintaan']);
    //             if ($data['tanggal'] >= $start_date && $data['tanggal'] <= $end_date) {
    //                 $barang = $this->barangModel->find($row['kode_barang']);
    //                 $data_pesanan[] = [
    //                     'kode_barang' => $barang['kode_barang'],
    //                     'nama_barang' => $barang['nama_barang'],
    //                     'jumlah' => $row['stok'],
    //                     'satuan' => $barang['satuan'],
    //                     'harga' => "",
    //                     'subTotal' => ""
    //                 ];
    //             }
    //         }

    //         if (isset($data_pesanan)) {
    //             $subTotal = 0;
    //             foreach ($data_pesanan as $row) {
    //                 $subTotal = $subTotal + (int)$row['subTotal'];
    //             }
    //         }

    //         $supplier = $this->supplierModel->find($data['kode_supplier']);
    //         $kode_doc = [
    //             'kode_pesanan' => $data['kode_pesanan'],
    //             'tanggal' => $data['tanggal'],
    //             'supplier' => $supplier['nama_supplier']
    //         ];

    //         $active = true;
    //     }
    //     return [
    //         'active' => $active,
    //         'data_pesanan' => isset($data_pesanan) ? $data_pesanan : [],
    //         'kode_doc' => isset($kode_doc) ? $kode_doc : [],
    //         'subTotal' => isset($subTotal) ? $subTotal : []
    //     ];
    // }
}
