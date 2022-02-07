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
        $db_obat = $this->obatModel->findAll();
        if ($db_obat != []) {
            foreach ($db_obat as $obat) {
                if ($obat['stok'] < 1000) {
                    $stokObat[] = $obat;
                }
            }
        }
        $obatHabis = [
            'count' => (isset($stokObat)) ? count($stokObat) : 0,
            'title' => 'Stok Obat Hampir Habis'
        ];

        // Barang Keluar
        $totalTerpakai = 0;
        $tgl_resep = $this->resepModel->findAll();
        foreach ($tgl_resep as $tgl) {
            $tanggal = date("Y-m-d", strtotime($tgl['tanggal']));
            if ($tanggal == date('Y-m-d')) {
                $detail_resep = $this->resepDetailModel->findAll();
                foreach ($detail_resep as $detail) {
                    if ($detail['id_transaksi'] == $tgl['id_transaksi']) {
                        $resepToday[] = $detail;
                        $totalTerpakai = $totalTerpakai + $detail['jumlah'];
                    }
                }
            }
        }
        $obatTerpakai = [
            'count' => $totalTerpakai,
            'title' => 'Obat Terpakai Hari Ini'
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

        $obatMasuk = [
            'count' => $totalMasuk,
            'title' => 'Obat Masuk Hari Ini'
        ];

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'navLink' => 'dashboard',
            'obatHabis' => $obatHabis,
            'resepToday' => $obatTerpakai,
            'masukToday' => $obatMasuk,
            'db' => $this->db
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
                'is_active' => $is_active
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

    public function viewAkses($id)
    {
        $menu_akses = $this->aksesModel->orderBy('no_order', 'ASC')->findAll();
        $hakAkses = $this->hakAksesModel->findAll();
        foreach ($hakAkses as $hak) {
            if ($id == $hak['id_role']) {
                $currentAkses[] = $hak['id_menu'];
            }
        }

        return view('role/role_akses', [
            'title' => 'Daftar Hak Akses',
            'card_title' => 'Kelola Role Pengguna',
            'navLink' => 'role-pengguna',
            'menu_akses' => $menu_akses,
            'currentAkses' => isset($currentAkses) ? $currentAkses : ''
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

    public function resep_pasien()
    {
        $data_dokter = $this->dokterModel->orderBy('nama_dokter', 'ASC')->findAll();
        $data_pasien = $this->pasienModel->orderBy('no_resep', 'ASC')->findAll();

        foreach ($data_pasien as $pasien) {
            $no_resep = $pasien['no_resep'];
        }
        $noUrut = (int) substr($no_resep, 0, 6);
        $noUrut++;
        $kodeBaru = sprintf("%06s", $noUrut);

        $status = [
            "0" => "BPJS",
            "1" => "UMUM"
        ];

        return view('dashboard/pasien', [
            'title' => 'Data Resep Pasien',
            'card_title' => 'Data Resep Pasien',
            'navLink' => 'resep-pasien',
            'jenis_kelamin' => $this->jenis_kelamin,
            'status_pasien' => $status,
            'db_dokter' => $data_dokter,
            'data_pasien' => $data_pasien,
            'kode_baru' => $kodeBaru
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

    public function stok_obat()
    {
        $stok_obat = $this->stokObatModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/stok_obat', [
            'title' => 'Stok Obat',
            'card_title' => 'Kelola Data Stok Obat',
            'navLink' => 'stok-obat',
            'stok_obat' => isset($stok_obat) ? $stok_obat : []
        ]);
    }

    public function obat_obatan()
    {
        $no_obat_akhir = $this->obatModel->orderBy('kode_obat', 'ASC')->findAll();
        foreach ($no_obat_akhir as $obat) {
            $kode_obat = $obat['kode_obat'];
        }

        $noUrut = (int) substr(preg_replace("/[^0-9]/", "", $kode_obat), 0, 6);
        $noUrut++;
        $kodeBaru = sprintf("%04s", $noUrut);

        $satuan_obat = [
            '0' => 'Tablet',
            '1' => 'Botol',
            '2' => 'Ampul',
            '3' => 'Strip',
            '4' => 'Sachet',
            '5' => 'Kapsul'
        ];

        return view('dashboard/obat_obatan', [
            'title' => 'Data Obat',
            'card_title' => 'Kelola Data Obat-Obatan',
            'navLink' => 'obat-obatan',
            'obat_obatan' => isset($no_obat_akhir) ? $no_obat_akhir : [],
            'satuan' => $satuan_obat,
            'kode_obat_baru' => $kodeBaru
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

    public function aturan_obat()
    {
        $aturan_obat = $this->aturanModel->orderBy('updated_at', 'DESC')->findAll();
        $aturan_usia = [
            '0' => 'Bayi',
            '1' => 'Anak-Anak',
            '2' => 'Dewasa',
        ];

        return view('dashboard/aturan_obat', [
            'title' => 'Data Aturan Obat',
            'card_title' => 'Data Aturan Pemakaian Obat',
            'navLink' => 'aturan-obat',
            'aturan_usia' => $aturan_usia,
            'aturan_obat' => isset($aturan_obat) ? $aturan_obat : []
        ]);
    }

    public function pengambilan_obat()
    {
        $data_resep = $this->ambilObatModel->orderBy('id_transaksi', 'ASC')->findAll();
        $resep_pasien = $this->pasienModel->orderBy('no_resep', 'ASC')->findAll();
        $obat_obatan = $this->obatModel->orderBy('kode_obat', 'ASC')->findAll();
        $aturan_obat = $this->aturanModel->orderBy('dosis_aturan_obat', 'DESC')->findAll();
        foreach ($data_resep as $maxId) {
        }
        return view('dashboard/pengambilan_obat', [
            'title' => 'Pengambilan Obat',
            'card_title' => 'Pengambilan Obat',
            'navLink' => 'pengambilan-obat',
            'resep_pasien' => isset($resep_pasien) ? $resep_pasien : [],
            'obat_obatan' => isset($obat_obatan) ? $obat_obatan : [],
            'aturan_obat' => isset($aturan_obat) ? $aturan_obat : [],
            'maxId' => $data_resep != [] ? $maxId['id_transaksi'] : 0
        ]);
    }

    public function resep_obat()
    {
        $resep_obat = $this->resepModel->orderBy('tanggal', 'DESC')->findAll();
        $detailObat = $this->resepDetailModel->orderBy('id_transaksi', 'ASC')->findAll();
        return view('dashboard/resep_obat', [
            'title' => 'Salinan Resep',
            'card_title' => 'Salinan Resep',
            'navLink' => 'resep-obat',
            'resep_obat' => isset($resep_obat) ? $resep_obat : [],
            'detailObat' => isset($detailObat) ? $detailObat : []
        ]);
    }

    public function riwayat_pengambilan_obat()
    {
        $resep_obat = $this->ambilObatModel->orderBy('tanggal', 'DESC')->findAll();
        $detailObat = $this->ambilObatDetailModel->orderBy('id_transaksi', 'ASC')->findAll();
        return view('dashboard/riwayat_ambil_obat', [
            'title' => 'Riwayat Pengambilan Obat',
            'card_title' => 'Riwayat Pengambilan Obat',
            'navLink' => 'riwayat-pengambilan-obat',
            'resep_obat' => isset($resep_obat) ? $resep_obat : [],
            'detailObat' => isset($detailObat) ? $detailObat : []
        ]);
    }

    public function pesanan_obat()
    {
        return view('dashboard/pesanan_obat', [
            'title' => 'Pengajuan Obat',
            'card_title' => 'Pengajuan Obat',
            'navLink' => 'pengajuan-obat',
            'permintaan_obat' => $this->permintaanModel->orderBy('tanggal', 'DESC')->findAll(),
            'supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll(),
            'detailObat' => $this->permintaanDetailModel->findAll(),
            'obatModel' => $this->obatModel
        ]);
    }

    public function barang_masuk()
    {
        return view('dashboard/barang_masuk', [
            'title' => 'Pengajuan Obat',
            'card_title' => 'Pengajuan Obat',
            'navLink' => 'barang-masuk',
            'pembelian' => $this->pembelianModel->orderBy('tanggal', 'DESC')->findAll(),
            'detailObat' => $this->pembelianDetailModel->findAll(),
            'supplier' => $this->supplierModel,
            'obatModel' => $this->obatModel
        ]);
    }
}
