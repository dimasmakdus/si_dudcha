<?php

namespace App\Controllers;

use DateTime;

class ResepObat extends BaseController
{
    public function resepAdd()
    {
        $data_resep = $this->resepModel->orderBy('id_transaksi', 'ASC')->findAll();
        foreach ($data_resep as $maxId) {
        }
        return view('resep/resep_add', [
            'title' => 'Tambah Salinan Resep',
            'card_title' => 'Tambah Salinan Resep',
            'navLink' => 'resep-obat',
            'resep_pasien' => $this->pasienModel->orderBy('no_resep', 'ASC')->findAll(),
            'obat_obatan' => $this->obatModel->orderBy('kode_obat', 'ASC')->findAll(),
            'aturan_obat' => $this->aturanModel->orderBy('dosis_aturan_obat', 'DESC')->findAll(),
            'maxId' => $data_resep != [] ? $maxId['id_transaksi'] : 0
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

        return view('resep/resep_cetak', [
            'title' => 'Cetak Salinan Resep',
            'navLink' => 'resep-obat',
            'resepPasien' => $resepPasien,
            'detailObat' => $detailObat,
            'tgl_resep' => $this->tanggal(date("Y-m-d", strtotime($resepPasien['tanggal']))),
        ]);
    }

    // Pengambilan Obat
    public function create()
    {
        $no_resep = $this->request->getVar('no_resep');
        $kode_obat = $this->request->getVar('kode_obat');
        $nama_obat = $this->request->getVar('nama_obat');
        $satuan = $this->request->getVar('satuan');
        $jumlah = $this->request->getVar('jumlah');
        $dosis_aturan_obat = $this->request->getVar('dosis_aturan');
        $tgl = date("Y-m-d H:i:s");

        $tmb_trans = $this->ambilObatModel->orderBy('id_transaksi', 'ASC')->findAll();
        if ($tmb_trans != array()) {
            foreach ($tmb_trans as $trans) {
                $nomor_db = $trans['id_transaksi'] + 1;
            }
        } else {
            $nomor_db = 1;
        }

        $dosis = $dosis_aturan_obat != null ? $dosis_aturan_obat : [];
        $checked = false;
        if ($dosis != []) {
            foreach ($dosis as $value) {
                if ($value == "") {
                    $checked = true;
                    echo "empty_dosis";
                    die;
                }
            }
        } else {
            $checked = true;
            echo "empty_obat";
            die;
        }

        if (!$checked) {
            $resep_pasien = $this->pasienModel->find($no_resep);

            $totalResep = 0;
            for ($j = 0; $j < count($kode_obat); $j++) {
                $totalResep = $totalResep + $jumlah[$j];
            }

            $this->ambilObatModel->insert([
                'id_transaksi' => $nomor_db,
                'kode_resep' => $resep_pasien['no_resep'],
                'status_pasien' => $resep_pasien['status_pasien'],
                'nama_pasien' => $resep_pasien['nama_pasien'],
                'umur' => $resep_pasien['umur'],
                'alamat' => $resep_pasien['alamat'],
                'tanggal' => $tgl,
                'nama_dokter' => $resep_pasien['nama_dokter'],
                'total' => $totalResep
            ]);

            for ($i = 0; $i < count($kode_obat); $i++) {
                $this->ambilObatDetailModel->insert([
                    'id_transaksi' => $nomor_db,
                    'kode_obat' => $kode_obat[$i],
                    'nama_obat' => $nama_obat[$i],
                    'jumlah' => $jumlah[$i],
                    'satuan' => $satuan[$i],
                    'dosis_aturan_obat' => $dosis_aturan_obat[$i]
                ]);

                $obat = $this->obatModel->find($kode_obat[$i]);
                $stok_akhir = $obat['stok'] - $jumlah[$i];

                // barang keluar
                $this->stokObatModel->insert([
                    'kode_obat' => $kode_obat[$i],
                    'tanggal' => $tgl,
                    'stok_awal' => $obat['stok'],
                    'stok_keluar' => $jumlah[$i],
                    'stok_akhir' => $stok_akhir
                ]);

                // pengurangan sisa stok
                $this->obatModel->update($kode_obat[$i], [
                    'nama_obat' => $nama_obat[$i],
                    'stok' => $stok_akhir,
                    'satuan' => $satuan[$i]
                ]);
            }
            redirect()->with('success', 'Data Pengambilan obat berhasil di tambahkan');
            echo "success";
        } else {
            echo "empty_dosis";
            die;
        }
    }

    // Tambah Salinan Resep
    public function postSalinanResep()
    {
        $no_resep = $this->request->getVar('no_resep');
        $kode_obat = $this->request->getVar('kode_obat');
        $nama_obat = $this->request->getVar('nama_obat');
        $satuan = $this->request->getVar('satuan');
        $jumlah = $this->request->getVar('jumlah');
        $dosis_aturan_obat = $this->request->getVar('dosis_aturan');
        $tgl = date("Y-m-d H:i:s");

        $tmb_trans = $this->resepModel->orderBy('id_transaksi', 'ASC')->findAll();
        if ($tmb_trans != array()) {
            foreach ($tmb_trans as $trans) {
                $nomor_db = $trans['id_transaksi'] + 1;
            }
        } else {
            $nomor_db = 1;
        }

        $dosis = $dosis_aturan_obat != null ? $dosis_aturan_obat : [];
        $checked = false;
        if ($dosis != []) {
            foreach ($dosis as $value) {
                if ($value == "") {
                    $checked = true;
                    echo "empty_dosis";
                    die;
                }
            }
        } else {
            $checked = true;
            echo "empty_obat";
            die;
        }

        if (!$checked) {
            $resep_pasien = $this->pasienModel->find($no_resep);

            $totalResep = 0;
            for ($j = 0; $j < count($kode_obat); $j++) {
                $totalResep = $totalResep + $jumlah[$j];
            }

            $this->resepModel->insert([
                'id_transaksi' => $nomor_db,
                'kode_resep' => $resep_pasien['no_resep'],
                'status_pasien' => $resep_pasien['status_pasien'],
                'nama_pasien' => $resep_pasien['nama_pasien'],
                'umur' => $resep_pasien['umur'],
                'alamat' => $resep_pasien['alamat'],
                'tanggal' => $tgl,
                'nama_dokter' => $resep_pasien['nama_dokter'],
                'total' => $totalResep
            ]);

            for ($i = 0; $i < count($kode_obat); $i++) {
                $this->resepDetailModel->insert([
                    'id_transaksi' => $nomor_db,
                    'kode_obat' => $kode_obat[$i],
                    'nama_obat' => $nama_obat[$i],
                    'jumlah' => $jumlah[$i],
                    'satuan' => $satuan[$i],
                    'dosis_aturan_obat' => $dosis_aturan_obat[$i]
                ]);
            }
            redirect()->with('success', 'Salinan Resep berhasil di tambahkan');
            echo "success";
        } else {
            echo "empty_dosis";
            die;
        }
    }

    public function remove($id)
    {
        $this->resepModel->delete($id);
        return redirect()->to('resep-obat')->with('success', 'Data Resep Berhasil Dihapus');
    }
}
