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

        foreach ($this->obatModel->orderBy('stok', 'ASC')->findAll() as $obat) {
            if ($obat['stok'] < 50) {
                $obat_kosong[] = $obat;
            }
        }

        return view('pesanan/pesanan_add', [
            'title' => 'Tambah Pengajuan Obat',
            'navLink' => 'pengajuan-obat',
            'data_supplier' => $this->supplierModel->orderBy('updated_at', 'ASC')->findAll(),
            'no_pemesanan' => $no_pemesanan,
            'obat_kosong' => $obat_kosong
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
                    'stok' => $detail['stok']
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

    public function kirim_email()
    {
        $post = $this->request->getVar();
        print_r($post);
        die;
        // $getSupplier = $this->supplierModel->find($post['kode-supplier']);

        // return redirect()->to('pesanan-obat')->with($status, 'Pesanan Obat ' . $msg . ' ke ' . $getSupplier['email']);
    }

    public function create()
    {
        $no_pesanan = $this->request->getVar('no_pesanan');
        $kode_supplier = $this->request->getVar('kode-supplier');
        $kode_obat = $this->request->getVar('kode_obat');
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

        if ($kode_obat != null) {
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
                    'kode_obat' => $kode_obat[$i]
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

    private function sendEmail($email_pengirim, $pass_pengirim, $email, $nama, $pengirim, $subject_msg, $body_msg, $file_tmp, $file_name)
    {
        $mail = new PHPMailer(true);
        $mail_host          = 'smtp.gmail.com';

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $mail_host;                             //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $email_pengirim;                         //SMTP username
            $mail->Password   = $pass_pengirim;                             //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPSecure = "ssl";

            //Recipients
            $mail->setFrom($email_pengirim, $pengirim);
            $mail->addAddress($email, $nama);     //Add a recipient
            $mail->addReplyTo($email_pengirim, $pengirim);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject_msg;
            $mail->Body    = $body_msg;
            $mail->AddAttachment($file_tmp, $file_name);

            $mail->send();
            return true;
            // return 'Message has been sent';
        } catch (Exception $e) {
            return false;
            // return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
