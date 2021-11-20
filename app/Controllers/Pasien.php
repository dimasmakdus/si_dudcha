<?php

namespace App\Controllers;

class Pasien extends BaseController
{
    public function pasienAdd()
    {
        foreach ($this->pasienModel->orderBy('no_rekamedis', 'ASC')->findAll() as $pasien) {
            $no_rekamedis = $pasien['no_rekamedis'];
        }
        $noUrut = (int) substr($no_rekamedis, 0, 6);
        $noUrut++;
        $kodeBaru = sprintf("%06s", $noUrut);

        return view('pasien/pasien_add', [
            'title' => 'Form Tambah Data Pasien',
            'navLink' => 'pasien',
            'kode_baru' => $kodeBaru
        ]);
    }

    public function pasienEdit($id)
    {
        $status_pasien = ['BPJS', 'Umum'];
        $jenis_kelamin = [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan'
        ];
        $getPasienById = $this->pasienModel->find($id);

        return view('pasien/pasien_edit', [
            'title' => 'Form Ubah Data Pasien',
            'navLink' => 'pasien',
            'statusPasien' => $status_pasien,
            'jenisKelamin' => $jenis_kelamin,
            'getPasien' => $getPasienById
        ]);
    }
}
