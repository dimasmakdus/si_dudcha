<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PesananBarang extends BaseController
{
    private $status = [
        'waiting' => 'Menunggu Persetujuan',
        'approved' => 'Disetujui',
        'cancel' => 'Ditolak'
    ];

    function dataBarangPesanan($kode)
    {
        $data_barang = $this->barangModel->orderBy('kode_barang', 'ASC')
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan_beli', 'left')
            ->find($kode);

        return json_encode($data_barang);
    }

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
            'permintaan_barang' => $this->permintaanModel->orderBy('tanggal', 'DESC')->findAll(),
            'data_supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll()
        ]);
    }

    // Form Tambah Pengajuan Barang
    public function pesananAdd()
    {
        $permintaan_barang = $this->permintaanModel->orderBy('kode_pesanan', 'ASC')->findAll();
        if ($permintaan_barang != []) {
            foreach ($permintaan_barang as $pesanan) {
                $lastId = $pesanan['id'];
            }
            $no_pemesanan = "P" . date("Y") . date("m") . sprintf("%05d", $lastId + 1);
        } else {
            $no_pemesanan = "P" . date("Y") . date("m") . sprintf("%05d", 1);
        }

        $data_barang = $this->barangModel->orderBy('kode_barang', 'ASC')
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan_beli', 'left')
            ->select('kode_barang')
            ->select('nama_barang')
            ->select('stok')
            ->select('stok_minimum')
            ->select('satuan_barang_id AS satuan_beli_id')
            ->select('satuan_barang_name AS satuan_beli')
            ->select('harga_beli')
            ->select('harga_jual')
            ->findAll();

        foreach ($data_barang as $barang) {
            // Stok Habis Minimal
            $stok = isset($barang['stok']) || $barang['stok'] != null ? $barang['stok'] : 0;
            $stok_min = isset($barang['stok_minimum']) || $barang['stok_minimum'] != null ? $barang['stok_minimum'] : 0;
            if ($stok < $stok_min) {
                $barang_kosong[] = $barang;
            }
        }

        $satuan_barang = $this->satuanBarangModel->findAll();
        return view('pesanan/pesanan_add', [
            'title' => 'Tambah Pengajuan Barang',
            'navLink' => 'pengajuan-barang',
            'data_supplier' => $this->supplierModel->orderBy('updated_at', 'ASC')->findAll(),
            'no_pemesanan' => $no_pemesanan,
            'data_barang' => $this->barangModel->orderBy('kode_barang', 'ASC')->where('stok < stok_minimum')->findAll(),
            'satuan_barang' => isset($satuan_barang) ? $satuan_barang : [],
            'barang_kosong' => isset($barang_kosong) ? $barang_kosong : []
        ]);
    }

    // Form Approve/Reject Pengajuan Barang (Atasan)
    function pesananEdit($id)
    {
        $proses = $this->permintaanModel->find($id);
        $detail_barang = $this->permintaanDetailModel
            ->where('id_permintaan', $id)
            ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_permintaan_detail.satuan_barang_id', 'left')
            ->findAll();

        return view('pesanan/cek_pesanan_edit', [
            'title' => 'Proses Pengajuan Pemesanan',
            'card_title' => 'Proses Pengajuan Pemesanan',
            'navLink' => 'cek-pesanan',
            'status' => $this->status,
            'proses' => $proses,
            'data_barang' => $detail_barang,
            'data_supplier' => $this->supplierModel->orderBy('nama_supplier', 'ASC')->findAll()
        ]);
    }

    // Proses Tambah Pengajuan Barang
    public function create()
    {
        $no_pesanan = $this->request->getVar('no_pesanan');
        $kode_supplier = $this->request->getVar('kode-supplier');
        $kode_barang = $this->request->getVar('kode_barang');
        $satuan_barang = $this->request->getVar('satuan_barang');
        $harga_beli = $this->request->getVar('harga_beli');
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
            $totalBarang = 0;
            for ($i = 0; $i < count($kode_barang); $i++) {
                $totalBarang = $totalBarang + ($stok[$i] * $harga_beli[$i]);
            }

            $this->permintaanModel->insert([
                'id' => $id_permintaan,
                'kode_pesanan' => $no_pesanan,
                'tanggal' => $today,
                'kode_supplier' => $kode_supplier,
                'status' => 'waiting',
                'proses' => 0,
                'total' => $totalBarang
            ]);

            for ($i = 0; $i < count($kode_barang); $i++) {
                $db_barang = $this->barangModel->select('nama_barang')->find($kode_barang[$i]);

                $this->permintaanDetailModel->insert([
                    'id_permintaan' => $id_permintaan,
                    'kode_barang' => $kode_barang[$i],
                    'nama_barang' => $db_barang['nama_barang'],
                    'satuan_barang_id' => $satuan_barang[$i],
                    'stok' => $stok[$i],
                    'harga_beli' => $harga_beli[$i]
                ]);
            }
            echo "success";
            $this->sendNotification(2, session()->get('name'), 'Pesanan Barang menunggu konfirmasi atasan', '/cek-pesanan');
            redirect()->with('success', 'Data Pesanan Barang Berhasil Terkirim');
        } else {
            echo "error";
            die;
        }
    }

    // Proses Approve/Reject Pengajuan Barang (Atasan)
    public function update()
    {
        // print_r($this->request->getVar());
        // die;
        $id_pesanan = $this->request->getVar('id_pesanan');
        $id_detail = $this->request->getVar('id_detail');
        $kode_supplier = $this->request->getVar('kode_supplier');
        $kode_barang = $this->request->getVar('kode_barang');
        $nama_barang = $this->request->getVar('nama_barang');
        $satuan_barang_id = $this->request->getVar('satuan_barang_id');
        $status = $this->request->getVar('status');
        $keterangan = $this->request->getVar('keterangan');
        $qty = $this->request->getVar('qty');
        $harga_beli = $this->request->getVar('harga_beli');

        $checked = false;
        foreach ($qty as $value) {
            if ($value == "" || $value <= 0) {
                $checked = true;
                echo "empty_qty";
                die;
            }
        }

        if (!$checked) {
            $totalBarang = 0;
            for ($j = 0; $j < count($qty); $j++) {
                $totalBarang = $totalBarang + ($qty[$j] * $harga_beli[$j]);
            }

            $this->permintaanModel->update($id_pesanan, [
                'kode_supplier' => $kode_supplier,
                'status' => $status,
                'keterangan' => $status == 'cancel' ? $keterangan : '',
                'total' => $totalBarang
            ]);

            $this->permintaanDetailModel->where('id_permintaan', $id_pesanan)->delete();
            for ($i = 0; $i < count($qty); $i++) {
                // $this->permintaanDetailModel->update($id_detail[$i], [
                //     'stok' => $qty[$i],
                // ]);
                $this->permintaanDetailModel->insert([
                    'id_permintaan' => $id_pesanan,
                    'kode_barang' => $kode_barang[$i],
                    'stok' => $qty[$i],
                    'nama_barang' => $nama_barang[$i],
                    'satuan_barang_id' => $satuan_barang_id[$i],
                    'harga_beli' => $harga_beli[$i],
                ]);
            }

            if ($status == 'approved') {
                $this->sendNotification(1, session()->get('name'), 'Pengajuan Barang telah di setujui', '/pengajuan-barang');
            } else if ($status == 'cancel') {
                $this->sendNotification(1, session()->get('name'), 'Pengajuan Barang telah di tolak', '/pengajuan-barang');
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
        $this->permintaanModel->delete($id);
        $this->permintaanDetailModel->where('id_permintaan', $id)->delete();
        return redirect()->to('cek-pesanan')->with('success', 'Data Pengajuan Barang Berhasil Dihapus');
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

        // return redirect()->to('pesanan-barang')->with($status, 'Pesanan Barang ' . $msg . ' ke ' . $getSupplier['email']);
    }
}
