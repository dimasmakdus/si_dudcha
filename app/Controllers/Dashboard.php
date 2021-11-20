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
            'pengguna' => $pengguna
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
            'navLink' => 'kelola_pengguna',
            'dataUser' => $dataUser
        ]);
    }

    public function pasien()
    {
        $data_pasien = $this->pasienModel->orderBy('no_rekamedis', 'DESC')->findAll();

        return view('dashboard/pasien', [
            'title' => 'Data Pasien',
            'card_title' => 'Kelola Data Pasien',
            'navLink' => 'pasien',
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
            'data_supplier' => $supplier
        ]);
    }

    public function stok_obat()
    {
        $stok_obat = $this->stokObatModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/stok_obat', [
            'title' => 'Stok Obat',
            'card_title' => 'Kelola Data Stok Obat',
            'navLink' => 'stok_obat',
            'stok_obat' => $stok_obat
        ]);
    }

    public function obat_obatan()
    {
        $obat_obatan = $this->obatModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/obat_obatan', [
            'title' => 'Obat-Obatan',
            'card_title' => 'Kelola Data Obat-Obatan',
            'navLink' => 'obat_obatan',
            'obat_obatan' => $obat_obatan
        ]);
    }

    public function resep_obat()
    {
        $resep_obat = $this->resepModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/resep_obat', [
            'title' => 'Resep Obat',
            'card_title' => 'Kelola Data Resep Obat',
            'navLink' => 'resep_obat',
            'resep_obat' => $resep_obat
        ]);
    }

    public function permintaan_obat()
    {
        $permintaan_obat = $this->permintaanModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/permintaan_obat', [
            'title' => 'Data Permintaan Obat',
            'card_title' => 'Kelola Data Permintaan Obat',
            'navLink' => 'permintaan_obat',
            'permintaan_obat' => $permintaan_obat
        ]);
    }

    public function pengeluaran_harian()
    {
        $pemakaian_obat = $this->pengeluaranModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/pengeluaran_harian', [
            'title' => 'Data Pengeluaran Harian',
            'card_title' => 'Kelola Data Pengeluaran Harian',
            'navLink' => 'pengeluaran_harian',
            'pemakaian_obat' => $pemakaian_obat
        ]);
    }

    public function laporan_barang_keluar()
    {
        $laporan_barang_keluar = $this->barangKeluarModel->orderBy('updated_at', 'DESC')->findAll();

        return view('dashboard/laporan_barang_keluar', [
            'title' => 'Laporan Barang Keluar',
            'card_title' => 'Laporan Data Barang Keluar',
            'navLink' => 'laporan_keluar',
            'laporan_barang_keluar' => $laporan_barang_keluar
        ]);
    }
}
