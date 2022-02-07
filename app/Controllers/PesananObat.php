<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PesananObat extends BaseController
{
    private $status = [
        'waiting' => 'Menunggu Persetujuan',
        'approved' => 'Disetujui',
        'cancel' => 'Ditolak'
    ];

    function kirimPesanan()
    {
        return view('dashboard/kirim_pesanan', [
            'title' => 'Kirim Email',
            'navLink' => 'kirim-pesanan',
            'data_supplier' => $this->supplierModel->orderBy('email', 'ASC')->findAll(),
        ]);
    }
    function cekPesanan()
    {
        return view('dashboard/cek_pesanan', [
            'title' => 'Cek Pengajuan Pemesanan',
            'card_title' => 'Cek Pengajuan Pemesanan',
            'navLink' => 'cek-pesanan',
            'permintaan_obat' => $this->permintaanModel->orderBy('tanggal', 'DESC')->findAll(),
            'data_supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll()
        ]);
    }

    public function pesananAdd()
    {
        $permintaan_obat = $this->permintaanModel->orderBy('kode_pesanan', 'ASC')->findAll();
        if ($permintaan_obat != []) {
            foreach ($permintaan_obat as $pesanan) {
                $lastId = $pesanan['id'];
            }
            $no_pemesanan = "P" . date("Y") . date("m") . sprintf("%05d", $lastId + 1);
        } else {
            $no_pemesanan = "P" . date("Y") . date("m") . sprintf("%05d", 1);
        }

        foreach ($this->obatModel->orderBy('kode_obat', 'ASC')->findAll() as $obat) {
            if ($obat['stok'] < 1000) {
                $obat_kosong[] = $obat;
            }
        }

        return view('pesanan/pesanan_add', [
            'title' => 'Tambah Pengajuan Obat',
            'navLink' => 'pengajuan-obat',
            'data_supplier' => $this->supplierModel->orderBy('updated_at', 'ASC')->findAll(),
            'no_pemesanan' => $no_pemesanan,
            'data_obat' => $this->obatModel->orderBy('kode_obat', 'ASC')->findAll(),
            'obat_kosong' => isset($obat_kosong) ? $obat_kosong : []
        ]);
    }

    function pesananEdit($id)
    {
        $proses = $this->permintaanModel->find($id);
        $detail_pesanan = $this->permintaanDetailModel->findAll();
        foreach ($detail_pesanan as $detail) {
            if ($detail['id_permintaan'] == $proses['id']) {
                $obat = $this->obatModel->find($detail['kode_obat']);
                $detail_obat[] = [
                    'id' => $detail['id'],
                    'kode_obat' => $obat['kode_obat'],
                    'nama_obat' => $obat['nama_obat'],
                    'satuan' => $obat['satuan'],
                    'stok' => $detail['stok'],
                    'tgl_kadaluarsa' => date("Y-m-d", strtotime('+5 years', strtotime('+4 days', strtotime('+4 months'))))
                ];
            }
        }

        return view('pesanan/cek_pesanan_edit', [
            'title' => 'Proses Pengajuan Pemesanan',
            'card_title' => 'Proses Pengajuan Pemesanan',
            'navLink' => 'cek-pesanan',
            'status' => $this->status,
            'proses' => $proses,
            'data_obat' => $detail_obat,
            'data_supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll()
        ]);
    }

    public function create()
    {
        $no_pesanan = $this->request->getVar('no_pesanan');
        $kode_supplier = $this->request->getVar('kode-supplier');
        $kode_obat = $this->request->getVar('kode_obat');
        $stok = $this->request->getVar('stok');
        $today = date("Y-m-d H:i:s");

        $permintaan = $this->permintaanModel->findAll();
        if ($permintaan != []) {
            foreach ($permintaan as $row) {
                if ($row['kode_pesanan'] != $no_pesanan) {
                    $id_permintaan = $row['id'] + 1;
                }
            }
        } else {
            $id_permintaan = 1;
        }

        $ajukan = $stok != null ? $stok : [];
        $checked = false;
        if ($ajukan != []) {
            foreach ($ajukan as $value) {
                if ($value == "") {
                    $checked = true;
                    echo "empty_stok";
                    die;
                }
            }
        } else {
            $checked = true;
            echo "empty_stok";
            die;
        }

        if (!$checked) {
            $this->permintaanModel->insert([
                'id' => $id_permintaan,
                'kode_pesanan' => $no_pesanan,
                'tanggal' => $today,
                'kode_supplier' => $kode_supplier,
                'status' => 'waiting',
                'proses' => 0,
            ]);

            for ($i = 0; $i < count($kode_obat); $i++) {
                $this->permintaanDetailModel->insert([
                    'id_permintaan' => $id_permintaan,
                    'kode_obat' => $kode_obat[$i],
                    'stok' => $stok[$i]
                ]);
            }
            echo "success";
            redirect()->with('success', 'Data Pesanan Obat Berhasil Terkirim');
        } else {
            echo "error";
            die;
        }
    }

    public function update()
    {
        $id_pesanan = $this->request->getVar('id_pesanan');
        $id_detail = $this->request->getVar('id_detail');
        $kode_supplier = $this->request->getVar('kode_supplier');
        $status = $this->request->getVar('status');
        $qty = $this->request->getVar('qty');

        $checked = false;
        foreach ($qty as $value) {
            if ($value == "" || $value <= 0) {
                $checked = true;
                echo "empty_qty";
                die;
            }
        }

        if (!$checked) {
            $this->permintaanModel->update($id_pesanan, [
                'kode_supplier' => $kode_supplier,
                'status' => $status
            ]);

            for ($i = 0; $i < count($qty); $i++) {
                $this->permintaanDetailModel->update($id_detail[$i], [
                    'stok' => $qty[$i],
                ]);
            }
            echo "success";
            redirect()->with('success', 'Proses Pengajuan Pemesanan Berhasil Di Perbaharui');
        } else {
            echo "error";
            die;
        }
    }

    public function remove($id)
    {
        $this->pesananModel->delete($id);
        return redirect()->to('pesanan-obat')->with('success', 'Data Pesanan Obat Berhasil Dihapus');
    }

    public function kirim_email()
    {
        $post = $this->request->getVar();
        $file = $this->request->getFile('fileupload');
        $fileName = $file->getName();
        $pathName = $file->getPathName();

        require '../vendor/autoload.php';
        $mail = new PHPMailer(true);
        $mail_host          = 'smtp.gmail.com';

        //Server settings
        $mail->isSMTP();
        $mail->Host       = $mail_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $post['email'];
        $mail->Password   = $post['password'];
        $mail->Port       = 465;
        $mail->SMTPSecure = "ssl";

        //Recipients
        $mail->setFrom($post['email'], $post['pengirim']);
        $mail->addAddress($post['email_supplier']);
        $mail->addReplyTo($post['email'], $post['pengirim']);

        $mail->isHTML(true);
        $mail->Subject = $post['subject'];
        $mail->Body    = $post['body'];
        $mail->AddAttachment($pathName, $fileName);

        $maxsize = 512 * 1024;
        if ($file->getSize() > $maxsize) {
            echo "error_file";
            die;
        } else if ($mail->send()) {
            echo "success";
        } else {
            echo "error";
            die;
        }
        // $getSupplier = $this->supplierModel->find($post['kode-supplier']);

        // return redirect()->to('pesanan-obat')->with($status, 'Pesanan Obat ' . $msg . ' ke ' . $getSupplier['email']);
    }
}
