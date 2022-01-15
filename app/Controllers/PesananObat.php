<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PesananObat extends BaseController
{
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
            if ($obat['stok'] <= 0) {
                $obat_kosong[] = $obat;
            }
        }

        return view('pesanan/pesanan_add', [
            'title' => 'Tambah Pengajuan Obat',
            'navLink' => 'pengajuan-obat',
            'accessRight' => $this->accessRights,
            'data_supplier' => $this->supplierModel->orderBy('updated_at', 'ASC')->findAll(),
            'no_pemesanan' => $no_pemesanan,
            'obat_kosong' => $obat_kosong
        ]);
    }

    public function cetakLPO()
    {
        $getPesanan = $this->pesananModel->orderBy('updated_at', 'DESC')->findAll();

        $bulanIni =  $this->tgl_indo(date('Y-m'));
        $bulanDepan =  $this->tgl_indo(date('Y-m', strtotime(date('Y-m') . " +1 month")));

        return view('pesanan/cetak-lpo', [
            'title' => 'Cetak Laporan Pesanan Obat',
            'getPesanan' => $getPesanan,
            'bulanIni' => $bulanIni,
            'bulanDepan' => $bulanDepan
        ]);
    }

    public function email()
    {
        $post = $this->request->getVar();
        $getSupplier = $this->supplierModel->find($post['kode-supplier']);

        $subject = "PESANAN OBAT PUSKESMAS CIMAUNG";
        $pesan = "<p>
        Kepada Yth: <br>
        " . $getSupplier['nama_supplier'] . " <br>
        di <br>
        Tempat <br><br>
        <p>Berikut lampiran daftar obat yang di pesan:</p>
        Kode Obat : " . $post['kode_obat'] . " <br>
        Nama Obat : " . $post['nama_obat'] . " <br>
        Jenis Obat : " . $post['jenis_obat'] . " <br>
        Satuan : " . $post['satuan'] . " <br>
        Jumlah : " . $post['jumlah'] . " Buah <br>
        </p>
        <p>Hormat Kami</p>
        <p>(Apoteker)</p>";
        $sendMail = $this->sendEmail($getSupplier['email'], $getSupplier['nama_supplier'], $subject, $pesan);

        if ($sendMail) {
            $msg = 'Terkirim';
            $status = 'success';
        } else {
            $msg = 'Tidak Terkirim';
            $status = 'error';
        }
        $this->pesananModel->insert([
            'kode_obat' => $post['kode_obat'],
            'nama_obat' => $post['nama_obat'],
            'jenis_obat' => $post['jenis_obat'],
            'satuan' => $post['satuan'],
            'jumlah' => $post['jumlah'],
            'nama_supplier' => $getSupplier['nama_supplier'],
            'email_supplier' => $getSupplier['email'],
            'status' => $msg
        ]);
        return redirect()->to('pesanan-obat')->with($status, 'Pesanan Obat ' . $msg . ' ke ' . $getSupplier['email']);
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
                if ($row['kode_pesanan'] == $no_pesanan) {
                    $id_permintaan = $row['id'] + 1;
                }
            }
        } else {
            $id_permintaan = 1;
        }

        $this->permintaanModel->insert([
            'id' => $id_permintaan,
            'kode_pesanan' => $no_pesanan,
            'tanggal' => $today,
            'kode_supplier' => $kode_supplier,
            'status' => 'waiting',
            'proses' => 0,
        ]);

        for ($i = 0; $i < count($kode_obat); $i++) {
            $this->resepDetailModel->insert([
                'id_permintaan' => $id_permintaan,
                'kode_obat' => $kode_obat[$i]
            ]);
        }
    }

    public function remove($id)
    {
        $this->pesananModel->delete($id);
        return redirect()->to('pesanan-obat')->with('success', 'Data Pesanan Obat Berhasil Dihapus');
    }

    public function kirimUlang($id)
    {
        $db = $this->pesananModel->find($id);
        $subject = "PESANAN OBAT PUSKESMAS CIMAUNG";
        $pesan = "<p>
        Kepada Yth: <br>
        " . $db['nama_supplier'] . " <br>
        di <br>
        Tempat <br><br>
        <p>Berikut lampiran daftar obat yang di pesan:</p>
        Kode Obat : " . $db['kode_obat'] . " <br>
        Nama Obat : " . $db['nama_obat'] . " <br>
        Jenis Obat : " . $db['jenis_obat'] . " <br>
        Satuan : " . $db['satuan'] . " <br>
        Jumlah : " . $db['jumlah'] . " Buah <br>
        </p>
        <p>Hormat Kami</p>
        <p>(Apoteker)</p>";
        $sendMail = $this->sendEmail($db['email_supplier'], $db['nama_supplier'], $subject, $pesan);
        if ($sendMail) {
            $msg = 'Terkirim';
            $status = 'success';
        } else {
            $msg = 'Tidak Terkirim';
            $status = 'error';
        }
        $this->pesananModel->update($id, [
            'status' => $msg
        ]);
        return redirect()->to('pesanan-obat')->with($status, 'Pesanan Obat ' . $msg . ' ke ' . $db['email_supplier']);
    }

    private function sendEmail($email, $nama_pengirim, $subject_msg, $body_msg)
    {
        $mail = new PHPMailer(true);
        $mail_host          = 'smtp.outlook.com';
        $mail_username      = 'dimasmohamadmakdus@hotmail.com';
        $mail_pass          = '@man123';

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $mail_host;                             //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $mail_username;                         //SMTP username
            $mail->Password   = $mail_pass;                             //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($mail_username, 'PUSKESMAS CIMAUNG');
            $mail->addAddress($email, $nama_pengirim);     //Add a recipient
            $mail->addReplyTo($mail_username, 'PUSKESMAS CIMAUNG');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject_msg;
            $mail->Body    = $body_msg;

            $mail->send();
            return true;
            // return 'Message has been sent';
        } catch (Exception $e) {
            return false;
            // return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
