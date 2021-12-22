<?php

namespace App\Controllers;

use DateTime;

class PermintaanObat extends BaseController
{
    public function permintaanAdd()
    {
        return view('permintaan/permintaanObat_add', [
            'title' => 'Form Tambah Data Permintaan Obat',
            'navLink' => 'permintaan-obat',
            'accessRight' => $this->accessRights,
            'kodeObat' => $this->obatModel->findAll()
        ]);
    }

    public function cetakLPLPO()
    {
        $getLPLPO = $this->lplpoModel->findAll();

        $bulanIni =  $this->tgl_indo(date('Y-m'));
        $bulanDepan =  $this->tgl_indo(date('Y-m', strtotime(date('Y-m') . " +1 month")));

        return view('permintaan/cetak_lplpo', [
            'title' => 'Cetak LPLPO',
            'getLPLPO' => $getLPLPO,
            'bulanIni' => $bulanIni,
            'bulanDepan' => $bulanDepan
        ]);
    }

    public function create()
    {
        $post = $this->request->getVar();
        $kode_obat = $this->request->getVar('kode-stok-obat');
        $getObat = $this->obatModel->find($kode_obat);
        $data_obat = [
            'kode_obat' => $getObat['kode_obat'],
            'nama_obat' => $getObat['nama_obat'],
            'jenis_obat' => $getObat['jenis_obat'],
            'stok_awal' => $post['stok_awal'],
            'penerimaan' => $post['penerimaan'],
            'persediaan' => $post['persediaan'],
            'pemakaian' => $post['pemakaian'],
            'sisa_akhir' => $post['sisa_akhir'],
            'stok_optimum' => $post['stok_optimum'],
            'permintaan' => $post['permintaan'],
            'pemberian' => $post['pemberian'],
            'keterangan' => $post['keterangan'],
        ];
        $this->lplpoModel->insert($data_obat);
        return redirect()->to('permintaan-obat')->with('success', 'Data LPLPO Berhasil Ditambahkan');
    }

    public function remove($id)
    {
        $this->lplpoModel->delete($id);
        return redirect()->to('permintaan-obat')->with('success', 'Data LPLPO Berhasil Dihapus');
    }
}
