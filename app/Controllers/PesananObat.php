<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PesananObat extends BaseController
{
    public function pesananAdd()
    {
        return view('pesanan/pesanan_add', [
            'title' => 'Form Tambah Pesanan Obat',
            'navLink' => 'pesanan-obat',
            'accessRight' => $this->accessRights,
            'data_supplier' => $this->supplierModel->orderBy('updated_at', 'ASC')->findAll()
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

    public function create()
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
