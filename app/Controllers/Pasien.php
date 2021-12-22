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
            'kode_baru' => $kodeBaru,
            'accessRight' => $this->accessRights
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
            'getPasien' => $getPasienById,
            'accessRight' => $this->accessRights
        ]);
    }

    public function create()
    {
        $this->pasienModel->insert([
            'no_rekamedis' => $this->request->getVar('no-rekamedis'),
            'no_ktp' => $this->request->getVar('no-ktp'),
            'no_bpjs' => $this->request->getVar('no-bpjs'),
            'nama_pasien' => $this->request->getVar('nama-pasien'),
            'status_pasien' => $this->request->getVar('status-pasien'),
            'jenis_kelamin' => $this->request->getVar('jenis-kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat-lahir'),
            'tanggal_lahir' => date('d-m-Y', strtotime($this->request->getVar('tgl-lahir'))),
            'alamat' => $this->request->getVar('alamat')
        ]);
        return redirect()->to('pasien')->with('success', 'Data Pasien Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getVar('no-rekamedis');
        $this->pasienModel->update($id, [
            'no_ktp' => $this->request->getVar('no-ktp'),
            'no_bpjs' => $this->request->getVar('no-bpjs'),
            'nama_pasien' => $this->request->getVar('nama-pasien'),
            'status_pasien' => $this->request->getVar('status-pasien'),
            'jenis_kelamin' => $this->request->getVar('jenis-kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat-lahir'),
            'tanggal_lahir' => date('d-m-Y', strtotime($this->request->getVar('tgl-lahir'))),
            'alamat' => $this->request->getVar('alamat')
        ]);
        return redirect()->to('pasien')->with('success', 'Data Pasien Berhasil Diubah');
    }

    public function remove($id)
    {
        $this->pasienModel->delete($id);
        return redirect()->to('pasien')->with('success', 'Data Pasien Berhasil Dihapus');
    }
}
