<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    function tanggal($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function laporan_stok_obat()
    {
        $reqGet = $this->request->getGet();
        if (isset($reqGet['periode'])) {
            foreach ($this->stokObatModel->findAll() as $stok) {
                $to_obat = $this->obatModel->find($stok['kode_obat']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date >= $reqGet['start_date'] && $date <= $reqGet['end_date']) {
                    $getPeriode[] = [
                        'kode_obat' => $to_obat['kode_obat'],
                        'nama_obat' => $to_obat['nama_obat'],
                        'satuan' => $to_obat['satuan'],
                        'stok_awal' => $stok['stok_awal'] != null ? $stok['stok_awal'] : 0,
                        'stok_masuk' => $stok['stok_masuk'] != null ? $stok['stok_masuk'] : 0,
                        'stok_keluar' => $stok['stok_keluar'] != null ? $stok['stok_keluar'] : 0,
                        'stok_akhir' => $stok['stok_akhir'] != null ? $stok['stok_akhir'] : 0
                    ];
                } else {
                    $getPeriode = [];
                }
            }
        } else if (isset($reqGet['day'])) {
            foreach ($this->stokObatModel->findAll() as $stok) {
                $to_obat = $this->obatModel->find($stok['kode_obat']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date == $reqGet['date']) {
                    $getPeriode[] = [
                        'kode_obat' => $to_obat['kode_obat'],
                        'nama_obat' => $to_obat['nama_obat'],
                        'satuan' => $to_obat['satuan'],
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

        return view('laporan/laporan_stok_obat', [
            'title' => 'Laporan Persediaan Obat',
            'card_title' => 'Laporan Persediaan Obat',
            'navLink' => 'laporan-stok-obat',
            'perTanggal' => (isset($reqGet['date'])) ? $this->tanggal($reqGet['date']) : '',
            'today' => $this->tanggal(date('Y-m-d')),
            'reqGet' => $reqGet,
            'getPeriode' => $getPeriode,
            'total' => $total
        ]);
    }

    function cetak_lpo()
    {
        $reqGet = $this->request->getGet();
        if (isset($reqGet['periode'])) {
            foreach ($this->stokObatModel->findAll() as $stok) {
                $to_obat = $this->obatModel->find($stok['kode_obat']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date >= $reqGet['start_date'] && $date <= $reqGet['end_date']) {
                    $getPeriode[] = [
                        'kode_obat' => $to_obat['kode_obat'],
                        'nama_obat' => $to_obat['nama_obat'],
                        'satuan' => $to_obat['satuan'],
                        'stok_awal' => $stok['stok_awal'] != null ? $stok['stok_awal'] : 0,
                        'stok_masuk' => $stok['stok_masuk'] != null ? $stok['stok_masuk'] : 0,
                        'stok_keluar' => $stok['stok_keluar'] != null ? $stok['stok_keluar'] : 0,
                        'stok_akhir' => $stok['stok_akhir'] != null ? $stok['stok_akhir'] : 0,
                    ];
                } else {
                    $getPeriode = [];
                }
            }
        } else if (isset($reqGet['day'])) {
            foreach ($this->stokObatModel->findAll() as $stok) {
                $to_obat = $this->obatModel->find($stok['kode_obat']);
                $date = date("Y-m-d", strtotime($stok['tanggal']));
                if ($date == $reqGet['date']) {
                    $getPeriode[] = [
                        'kode_obat' => $to_obat['kode_obat'],
                        'nama_obat' => $to_obat['nama_obat'],
                        'satuan' => $to_obat['satuan'],
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
            'reqGet' => $reqGet,
            'getPeriode' => $getPeriode,
            'perTanggal' => (isset($reqGet['date'])) ? $this->tanggal($reqGet['date']) : '',
            'today' => $this->tanggal(date('Y-m-d')),
            'total' => $total
        ]);
    }

    function laporan_masuk()
    {
        return view('laporan/laporan_masuk', [
            'title' => 'Laporan Pemasukan',
            'card_title' => 'Laporan Pemasukan',
            'navLink' => 'laporan-masuk',
            'db' => $this->db,
            'reqGet' => $this->request->getGet()
        ]);
    }

    function cetak_lbm()
    {
        return view('laporan/cetak-lbm', [
            'db' => $this->db,
            'reqGet' => $this->request->getGet(),
            'today' => $this->tanggal(date('Y-m-d'))
        ]);
    }

    function laporan_keluar()
    {
        return view('laporan/laporan_keluar', [
            'title' => 'Laporan Pengeluaran',
            'card_title' => 'Laporan Pengeluaran',
            'navLink' => 'laporan-keluar',
            'db' => $this->db,
            'today' => $this->tanggal(date('Y-m-d')),
            'reqGet' => $this->request->getGet()
        ]);
    }

    function cetak_lbk()
    {
        return view('laporan/cetak-lbk', [
            'db' => $this->db,
            'reqGet' => $this->request->getGet(),
            'today' => $this->tanggal(date('Y-m-d'))
        ]);
    }

    function cetakPesanan($id)
    {
        $pesanan = $this->permintaanModel->find($id);
        foreach ($this->permintaanDetailModel->findAll() as $detail) {
            if ($id == $detail['id_permintaan']) {
                foreach ($this->obatModel->findAll() as $obat) {
                    if ($detail['kode_obat'] == $obat['kode_obat']) {
                        $data_pesanan[] = [
                            'kode_obat' => $obat['kode_obat'],
                            'nama_obat' => $obat['nama_obat'],
                            'jumlah' => $detail['stok'],
                            'satuan' => $obat['satuan'],
                            'harga' => "",
                            'subTotal' => ""
                        ];
                    }
                }
            }
        }

        $subTotal = 0;
        foreach ($data_pesanan as $row) {
            $subTotal = $subTotal + (int)$row['subTotal'];
        }

        $supplier = $this->supplierModel->find($pesanan['kode_supplier']);
        $laporan = [
            'kode_pesanan' => $pesanan['kode_pesanan'],
            'tanggal' => $pesanan['tanggal'],
            'supplier' => $supplier['nama_supplier']
        ];

        return view('laporan/cetak-pesanan', [
            'data_pesanan' => $data_pesanan,
            'laporan' => $laporan,
            'subTotal' => $subTotal,
            'today' => $this->tanggal(date('Y-m-d'))
        ]);
    }

    function laporan_permintaan()
    {
        $req = $this->reqPermintaan($this->request->getGet());
        $active = $req['active'];
        $data_pesanan = $req['data_pesanan'];
        $kode_doc = $req['kode_doc'];
        $subTotal = $req['subTotal'];

        return view('laporan/laporan_permintaan', [
            'title' => 'Laporan Permintaan',
            'card_title' => 'Laporan Permintaan',
            'navLink' => 'laporan-permintaan',
            'reqGet' => $this->request->getGet(),
            'today' => $this->tanggal(date('Y-m-d')),
            'subTotal' => $active ? $subTotal : [],
            'pesanan' => $active ? $data_pesanan : [],
            'doc' => $active ? $kode_doc : []
        ]);
    }
    function cetak_permintaan()
    {
        $req = $this->reqPermintaan($this->request->getGet());
        $active = $req['active'];
        $data_pesanan = $req['data_pesanan'];
        $kode_doc = $req['kode_doc'];
        $subTotal = $req['subTotal'];

        return view('laporan/cetak-pesanan', [
            'reqGet' => $this->request->getGet(),
            'today' => $this->tanggal(date('Y-m-d')),
            'subTotal' => $active ? $subTotal : [],
            'data_pesanan' => $active ? $data_pesanan : [],
            'laporan' => $active ? $kode_doc : []
        ]);
    }

    function reqPermintaan($reqGet)
    {
        $active = false;
        if (isset($reqGet['report'])) {
            $start_date = $reqGet['start_date'];
            $end_date = $reqGet['end_date'];

            foreach ($this->permintaanDetailModel->findAll() as $row) {
                $data = $this->permintaanModel->find($row['id_permintaan']);
                if ($data['tanggal'] >= $start_date && $data['tanggal'] <= $end_date) {
                    $obat = $this->obatModel->find($row['kode_obat']);
                    $data_pesanan[] = [
                        'kode_obat' => $obat['kode_obat'],
                        'nama_obat' => $obat['nama_obat'],
                        'jumlah' => $row['stok'],
                        'satuan' => $obat['satuan'],
                        'harga' => "",
                        'subTotal' => ""
                    ];
                }
            }

            if (isset($data_pesanan)) {
                $subTotal = 0;
                foreach ($data_pesanan as $row) {
                    $subTotal = $subTotal + (int)$row['subTotal'];
                }
            }

            $supplier = $this->supplierModel->find($data['kode_supplier']);
            $kode_doc = [
                'kode_pesanan' => $data['kode_pesanan'],
                'tanggal' => $data['tanggal'],
                'supplier' => $supplier['nama_supplier']
            ];

            $active = true;
        }
        return [
            'active' => $active,
            'data_pesanan' => isset($data_pesanan) ? $data_pesanan : [],
            'kode_doc' => isset($kode_doc) ? $kode_doc : [],
            'subTotal' => isset($subTotal) ? $subTotal : []
        ];
    }
}
