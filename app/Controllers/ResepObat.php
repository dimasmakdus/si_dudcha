<?php

namespace App\Controllers;

use DateTime;

class ResepObat extends BaseController
{
    public function resepAdd()
    {
        return view('resep/resep_add', [
            'title' => 'Form Tambah Resep Obat',
            'navLink' => 'resep-obat',
            'accessRight' => $this->accessRights,
            'getPasien' => $this->pasienModel->findAll()
        ]);
    }

    public function cetakResep($id)
    {
        $getResepId = $this->resepModel->find($id);
        $getPasien = $this->pasienModel->findAll();

        foreach ($getPasien as $pasien) {
            if ($getResepId['no_rekamedis'] == $pasien['no_rekamedis']) {
                $dataPasien[] = $pasien;
            }
        }

        // Umur
        $tgl_lahir = new DateTime($dataPasien[0]['tanggal_lahir']);
        $today = new DateTime('today');
        $year = $today->diff($tgl_lahir)->y;

        return view('resep/resep_cetak', [
            'title' => 'Cetak Salinan Resep',
            'navLink' => 'resep-obat',
            'getResep' => $getResepId,
            'byPasien' => $dataPasien[0],
            'year' => $year
        ]);
    }

    public function create()
    {
        $this->resepModel->insert($this->request->getVar());
        return redirect()->to('resep-obat')->with('success', 'Data Resep Berhasil Ditambahkan');
    }

    public function remove($id)
    {
        $this->resepModel->delete($id);
        return redirect()->to('resep-obat')->with('success', 'Data Resep Berhasil Dihapus');
    }
}
