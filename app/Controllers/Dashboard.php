<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    private $jenis_kelamin = [
        "0" => "Laki-Laki",
        "1" => "Perempuan"
    ];

    public function index()
    {
        // Stok Habis
        $db_barang = $this->barangModel->findAll();
        if ($db_barang != []) {
            foreach ($db_barang as $barang) {
                if ($barang['stok'] < $barang['stok_minimum']) {
                    $stokBarang[] = $barang;
                }
            }
        }
        $barangHabis = [
            'count' => (isset($stokBarang)) ? count($stokBarang) : 0,
            'title' => 'Stok Hampir Habis'
        ];

        // Barang Keluar
        $totalTerpakai = 0;
        $tgl_resep = $this->penjualanBarangModel->findAll();
        foreach ($tgl_resep as $tgl) {
            $tanggal = date("Y-m-d", strtotime($tgl['tanggal']));
            if ($tanggal == date('Y-m-d')) {
                $detail_resep = $this->penjualanBarangDetailModel->findAll();
                foreach ($detail_resep as $detail) {
                    if ($detail['id_transaksi'] == $tgl['id_transaksi']) {
                        $resepToday[] = $detail;
                        $totalTerpakai = $totalTerpakai + $detail['jumlah'];
                    }
                }
            }
        }
        $barangTerpakai = [
            'count' => $totalTerpakai,
            'title' => 'Barang Keluar Hari Ini'
        ];

        // Barang Masuk
        $totalMasuk = 0;
        $tgl_masuk = $this->pembelianModel->findAll();
        foreach ($tgl_masuk as $tgl) {
            $tanggal = date("Y-m-d", strtotime($tgl['tanggal']));
            if ($tanggal == date('Y-m-d')) {
                $detail_masuk = $this->pembelianDetailModel->findAll();
                foreach ($detail_masuk as $detail) {
                    if ($detail['id_pembelian'] == $tgl['id']) {
                        $resepToday[] = $detail;
                        $totalMasuk = $totalMasuk + $detail['stok_masuk'];
                    }
                }
            }
        }

        $barangMasuk = [
            'count' => $totalMasuk,
            'title' => 'Barang Masuk Hari Ini'
        ];

        // Terjual Hari ini
        // $totalPenjualan = 0;
        // $tgl_penjualan = $this->penjualanBarangModel->findAll();
        // foreach ($tgl_penjualan as $tgl) {
        //     $tanggal = date("Y-m-d", strtotime($tgl['tanggal']));
        //     if ($tanggal == date('Y-m-d')) {
        //         $detail_penjualan = $this->penjualanBarangDetailModel->findAll();
        //         foreach ($detail_penjualan as $detail) {
        //             if ($detail['id_transaksi'] == $tgl['id_transaksi']) {
        //                 $resepToday[] = $detail;
        //                 $totalPenjualan = $totalPenjualan + $detail['harga_jual'];
        //             }
        //         }
        //     }
        // }

        // $barangTerjual = [
        //     'count' => $totalPenjualan,
        //     'title' => 'Pendapatan Hari Ini'
        // ];

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'navLink' => 'dashboard',
            'barangHabis' => $barangHabis,
            'keluarToday' => $barangTerpakai,
            // 'terjualToday' => $barangTerjual,
            'barangMasuk' => $barangMasuk,
            'db' => $this->db
        ]);
    }

    public function notifikasi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_notifikasi');
        $notifikasi   = $builder->where('notifikasi_user_id', session()->get('id_user'))->get()->getResult();

        return view('dashboard/notifikasi', [
            'title' => 'Notifikasi',
            'card_title' => 'Notifikasi',
            'navLink' => 'dashboard',
            'notifikasi' => $notifikasi,
        ]);
    }

    public function kelola_user()
    {
        $users = $this->userModel->orderBy('updated_at', 'DESC')->findAll();
        $dataUser = [];
        foreach ($users as $user) {
            $id_role = $user['id_user_role'];
            $roleById = $this->roleModel->find($id_role);
            if ($user['is_active'] == 'y') {
                $is_active = "Aktif";
            } else {
                $is_active = "Tidak Aktif";
            }

            $data = [
                'id_user' => $user['id_user'],
                'full_name' => $user['full_name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'id_user_role' => $roleById['nama_role'],
                'is_active' => $is_active,
                'user_photo' => $user['user_photo'],
            ];
            array_push($dataUser, $data);
        }

        $is_active = [
            'y' => 'Aktif',
            'n' => 'Tidak Aktif'
        ];

        return view('user/user_list', [
            'title' => 'Kelola Pengguna',
            'card_title' => 'Kelola Data Pengguna',
            'navLink' => 'pengguna',
            'roles' => $this->roleModel->findAll(),
            'dataUser' => $dataUser,
            'is_active' => $is_active,
        ]);
    }

    public function roleUser()
    {
        $roles = $this->roleModel->orderBy('updated_at', 'DESC')->findAll();

        return view('role/role_user', [
            'title' => 'Role Pengguna',
            'card_title' => 'Kelola Role Pengguna',
            'navLink' => 'role-pengguna',
            'roles' => $roles
        ]);
    }

    public function roleForm()
    {
        return view('role/role_form', [
            'title' => 'Tambah Hak Akses',
            'card_title' => 'Tambah Hak Akses',
            'navLink' => 'role-pengguna',
        ]);
    }

    public function supplier()
    {
        $supplier = $this->supplierModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/supplier', [
            'title' => 'Data Supplier',
            'card_title' => 'Kelola Data Supplier',
            'navLink' => 'supplier',
            'data_supplier' => isset($supplier) ? $supplier : []
        ]);
    }

    public function outlet()
    {
        $outlet = $this->outletModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/data_outlet', [
            'title' => 'Data Outlet',
            'card_title' => 'Kelola Data Outlet',
            'navLink' => 'outlet',
            'data_outlet' => isset($outlet) ? $outlet : []
        ]);
    }

    public function jenis_barang()
    {
        $jenis_barang = $this->jenisBarangModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/data_jenis_barang', [
            'title' => 'Jenis Barang',
            'card_title' => 'Jenis Barang',
            'navLink' => 'jenis-barang',
            'data_jenis_barang' => isset($jenis_barang) ? $jenis_barang : []
        ]);
    }

    public function satuan_barang()
    {
        $satuan_barang = $this->satuanBarangModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/data_satuan_barang', [
            'title' => 'Satuan Barang',
            'card_title' => 'Satuan Barang',
            'navLink' => 'satuan-barang',
            'data_satuan_barang' => isset($satuan_barang) ? $satuan_barang : []
        ]);
    }

    public function stok_barang()
    {
        $stok_barang = $this->stokBarangModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/stok_barang', [
            'title' => 'Stok Barang',
            'card_title' => 'Kelola Data Stok Barang',
            'navLink' => 'stok-barang',
            'stok_barang' => isset($stok_barang) ? $stok_barang : []
        ]);
    }

    public function data_barang()
    {
        $no_barang_akhir = $this->barangModel
            ->orderBy('kode_barang', 'ASC')
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
            ->join('tbl_jenis_barang', 'tbl_jenis_barang.jenis_barang_id = tbl_barang.jenis_barang', 'left')
            ->findAll();

        foreach ($no_barang_akhir as $barang) {
            $kode_barang = $barang['kode_barang'];
        }

        $noUrut = (int) substr(preg_replace("/[^0-9]/", "", $kode_barang), 0, 6);
        $noUrut++;
        $kodeBaru = sprintf("%04s", $noUrut);

        $satuan_barang = $this->satuanBarangModel->orderBy('updated_at', 'ASC')->findAll();
        $jenis_barang = $this->jenisBarangModel->orderBy('updated_at', 'ASC')->findAll();

        return view('dashboard/data_barang', [
            'title' => 'Data Barang',
            'card_title' => 'Kelola Data Barang',
            'navLink' => 'data-barang',
            'data_barang' => isset($no_barang_akhir) ? $no_barang_akhir : [],
            'satuan' => isset($satuan_barang) ? $satuan_barang : [],
            'jenis_barang' => isset($jenis_barang) ? $jenis_barang : [],
            'kode_barang_baru' => $kodeBaru
        ]);
    }

    public function data_dokter()
    {
        $data_dokter = $this->dokterModel->orderBy('updated_at', 'DESC')->findAll();

        $poli = [
            "1" => "POLI GIGI",
            "2" => "POLI UMUM",
            "3" => "POLI KIA"
        ];

        return view('dashboard/dokter', [
            'title' => 'Data Dokter',
            'card_title' => 'Data Dokter',
            'navLink' => 'data-dokter',
            'data_dokter' => isset($data_dokter) ? $data_dokter : [],
            'jenis_kelamin' => $this->jenis_kelamin,
            'poli' => $poli
        ]);
    }

    public function aturan_barang()
    {
        $aturan_barang = $this->aturanModel->orderBy('updated_at', 'DESC')->findAll();
        $aturan_usia = [
            '0' => 'Bayi',
            '1' => 'Anak-Anak',
            '2' => 'Dewasa',
        ];

        return view('dashboard/aturan_barang', [
            'title' => 'Data Aturan Barang',
            'card_title' => 'Data Aturan Pemakaian Barang',
            'navLink' => 'aturan-barang',
            'aturan_usia' => $aturan_usia,
            'aturan_barang' => isset($aturan_barang) ? $aturan_barang : []
        ]);
    }

    public function penjualan_barang()
    {
        $data_penjualan = $this->penjualanBarangModel->orderBy('id_transaksi', 'ASC')->findAll();
        $barang_barangan = $this->barangModel
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
            ->orderBy('kode_barang', 'ASC')
            ->findAll();

        foreach ($data_penjualan as $maxId) {
        }

        $data_outlet = $this->outletModel->orderBy('outlet_name')->findAll();
        return view('dashboard/penjualan_barang', [
            'title' => 'Penjualan Barang',
            'card_title' => 'Penjualan Barang',
            'navLink' => 'penjualan-barang',
            'data_outlet' => isset($data_outlet) ? $data_outlet : [],
            'barang_barangan' => isset($barang_barangan) ? $barang_barangan : [],
            'maxId' => $data_penjualan != [] ? $maxId['id_transaksi'] : 0
        ]);
    }

    public function resep_barang()
    {
        $resep_barang = $this->resepModel->orderBy('tanggal', 'DESC')->findAll();
        $detailBarang = $this->resepDetailModel->orderBy('id_transaksi', 'ASC')->findAll();
        return view('dashboard/resep_barang', [
            'title' => 'Salinan Resep',
            'card_title' => 'Salinan Resep',
            'navLink' => 'resep-barang',
            'resep_barang' => isset($resep_barang) ? $resep_barang : [],
            'detailBarang' => isset($detailBarang) ? $detailBarang : []
        ]);
    }

    public function riwayat_penjualan_barang()
    {
        $penjualan_barang = $this->penjualanBarangModel->orderBy('tanggal', 'DESC')->findAll();
        $detailBarang = $this->penjualanBarangDetailModel
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_penjualan_barang_detail.satuan', 'left')
            ->orderBy('id_transaksi', 'ASC')
            ->findAll();
        return view('dashboard/riwayat_penjualan_barang', [
            'title' => 'Riwayat Penjualan Barang',
            'card_title' => 'Riwayat Penjualan Barang',
            'navLink' => 'riwayat-penjualan-barang',
            'penjualan_barang' => isset($penjualan_barang) ? $penjualan_barang : [],
            'detailBarang' => isset($detailBarang) ? $detailBarang : []
        ]);
    }

    public function pesanan_barang()
    {
        return view('dashboard/pesanan_barang', [
            'title' => 'Pengajuan Barang',
            'card_title' => 'Pengajuan Barang',
            'navLink' => 'pengajuan-barang',
            'permintaan_barang' => $this->permintaanModel->orderBy('tanggal', 'DESC')->findAll(),
            'supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll(),
            'detailBarang' => $this->permintaanDetailModel->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_permintaan_detail.satuan_barang_id', 'left')->findAll(),
            'barangModel' => $this->barangModel
        ]);
    }

    public function barang_masuk()
    {
        $status_pembayaran = [
            'true' => 'Lunas',
            'false' => 'Belum Lunas'
        ];

        return view('dashboard/barang_masuk', [
            'title' => 'Barang Masuk',
            'card_title' => 'Barang Masuk',
            'navLink' => 'barang-masuk',
            'pembelian' => $this->pembelianModel->orderBy('tanggal', 'DESC')->findAll(),
            'detailBarang' => $this->pembelianDetailModel->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_pembelian_detail.satuan_barang_id', 'left')->findAll(),
            'supplier' => $this->supplierModel,
            'barangModel' => $this->barangModel,
            'status_pembayaran' => $status_pembayaran,
        ]);
    }
}
