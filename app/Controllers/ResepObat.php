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
        $resepPasien = $this->resepModel->find($id);
        $detailResep = $this->resepDetailModel->findAll();

        foreach ($detailResep as $detail) {
            if ($resepPasien['id_transaksi'] == $detail['id_transaksi']) {
                $detailObat[] = $detail;
            }
        }

        $today = new DateTime('today');

        return view('resep/resep_cetak', [
            'title' => 'Cetak Salinan Resep',
            'navLink' => 'resep-obat',
            'resepPasien' => $resepPasien,
            'detailObat' => $detailObat
        ]);
    }

    public function create()
    {
        $no_resep = $this->request->getVar('no_resep');
        $kode_obat = $this->request->getVar('kode_obat');
        $nama_obat = $this->request->getVar('nama_obat');
        $satuan = $this->request->getVar('satuan');
        $jumlah = $this->request->getVar('jumlah');
        $tgl = date("Y-m-d H:i:s");

        $tmb_trans = $this->resepModel->orderBy('id_transaksi', 'ASC')->findAll();
        if ($tmb_trans != array()) {
            foreach ($tmb_trans as $trans) {
                $nomor_db = $trans['id_transaksi'] + 1;
            }
        } else {
            $nomor_db = 1;
        }

        $resep_pasien = $this->pasienModel->find($no_resep);
        $this->resepModel->insert([
            'id_transaksi' => $nomor_db,
            'kode_resep' => $resep_pasien['no_resep'],
            'status_pasien' => $resep_pasien['status_pasien'],
            'nama_pasien' => $resep_pasien['nama_pasien'],
            'umur' => $resep_pasien['umur'],
            'alamat' => $resep_pasien['alamat'],
            'tanggal' => $tgl
        ]);

        for ($i = 0; $i < count($kode_obat); $i++) {
            $this->resepDetailModel->insert([
                'id_transaksi' => $nomor_db,
                'kode_obat' => $kode_obat[$i],
                'nama_obat' => $nama_obat[$i],
                'jumlah' => $jumlah[$i],
                'satuan' => $satuan[$i]
            ]);

            $obat = $this->obatModel->find($kode_obat[$i]);
            $this->obatModel->update($kode_obat[$i], [
                'nama_obat' => $nama_obat[$i],
                'stok' => $obat['stok'] - $jumlah[$i],
                'satuan' => $satuan[$i]
            ]);
        }
    }

    public function remove($id)
    {
        $this->resepModel->delete($id);
        return redirect()->to('resep-obat')->with('success', 'Data Resep Berhasil Dihapus');
    }
}
