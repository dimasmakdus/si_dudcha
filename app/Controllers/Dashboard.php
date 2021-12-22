<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $obatobatan = [
            'count' => $this->obatModel->countAll(),
            'title' => 'Obat - Obatan'
        ];
        $pasien = [
            'count' => $this->pasienModel->countAll(),
            'title' => 'Data Pasian'
        ];
        $supplier = [
            'count' => $this->supplierModel->countAll(),
            'title' => 'Data Supplier'
        ];
        $pengguna = [
            'count' => $this->userModel->countAll(),
            'title' => 'Data Pengguna'
        ];

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'navLink' => 'dashboard',
            'obat' => $obatobatan,
            'pasien' => $pasien,
            'supplier' => $supplier,
            'pengguna' => $pengguna,
            'accessRight' => $this->accessRights
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

        return view('user/user_list', [
            'title' => 'Kelola Pengguna',
            'card_title' => 'Kelola Data Pengguna',
            'navLink' => 'pengguna',
            'accessRight' => $this->accessRights,
            'dataUser' => $dataUser
        ]);
    }

    public function roleUser()
    {
        $roles = $this->roleModel->orderBy('updated_at', 'DESC')->findAll();

        return view('role/role_user', [
            'title' => 'Role Pengguna',
            'card_title' => 'Kelola Role Pengguna',
            'navLink' => 'role-pengguna',
            'accessRight' => $this->accessRights,
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
            'accessRight' => $this->accessRights,
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
            'accessRight' => $this->accessRights,
        ]);
    }

    public function pasien()
    {
        $data_pasien = $this->pasienModel->orderBy('no_rekamedis', 'DESC')->findAll();

        return view('dashboard/pasien', [
            'title' => 'Data Pasien',
            'card_title' => 'Kelola Data Pasien',
            'navLink' => 'pasien',
            'accessRight' => $this->accessRights,
            'data_pasien' => $data_pasien
        ]);
    }

    public function supplier()
    {
        $supplier = $this->supplierModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/supplier', [
            'title' => 'Data Supplier',
            'card_title' => 'Kelola Data Supplier',
            'navLink' => 'supplier',
            'accessRight' => $this->accessRights,
            'data_supplier' => $supplier
        ]);
    }

    public function stok_obat()
    {
        $stok_obat = $this->stokObatModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/stok_obat', [
            'title' => 'Stok Obat',
            'card_title' => 'Kelola Data Stok Obat',
            'navLink' => 'stok-obat',
            'accessRight' => $this->accessRights,
            'stok_obat' => $stok_obat
        ]);
    }

    public function obat_obatan()
    {
        $obat_obatan = $this->obatModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/obat_obatan', [
            'title' => 'Obat-Obatan',
            'card_title' => 'Kelola Data Obat-Obatan',
            'navLink' => 'obat-obatan',
            'accessRight' => $this->accessRights,
            'obat_obatan' => $obat_obatan
        ]);
    }

    public function resep_obat()
    {
        $resep_obat = $this->resepModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/resep_obat', [
            'title' => 'Resep Obat',
            'card_title' => 'Kelola Data Resep Obat',
            'navLink' => 'resep-obat',
            'accessRight' => $this->accessRights,
            'resep_obat' => $resep_obat
        ]);
    }

    public function permintaan_obat()
    {
        $lplpo = $this->lplpoModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/permintaan_obat', [
            'title' => 'Laporan Pemakaian & Lembar Permintaan Obat',
            'card_title' => 'Laporan Pemakaian & Lembar Permintaan Obat',
            'navLink' => 'permintaan-obat',
            'accessRight' => $this->accessRights,
            'permintaan_obat' => $lplpo
        ]);
    }

    public function pengeluaran_harian()
    {
        $pemakaian_obat = $this->pengeluaranModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/pengeluaran_harian', [
            'title' => 'Data Pengeluaran Harian',
            'card_title' => 'Kelola Data Pengeluaran Harian',
            'navLink' => 'pengeluaran-harian',
            'accessRight' => $this->accessRights,
            'pemakaian_obat' => $pemakaian_obat
        ]);
    }

    public function laporan_barang_keluar()
    {
        $pemakaian_obat = $this->pengeluaranModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/laporan_barang_keluar', [
            'title' => 'Surat Bukti Barang Keluar',
            'card_title' => 'Laporan Data Barang Keluar',
            'navLink' => 'laporan-barang-keluar',
            'accessRight' => $this->accessRights,
            'laporan_barang_keluar' => $pemakaian_obat
        ]);
    }

    public function pesanan_obat()
    {
        $pesanan_obat = $this->pesananModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/pesanan_obat', [
            'title' => 'Data Pesanan Obat',
            'card_title' => 'Kelola Pesanan Obat',
            'navLink' => 'pesanan-obat',
            'accessRight' => $this->accessRights,
            'pesanan_obat' => $pesanan_obat
        ]);
    }
}
