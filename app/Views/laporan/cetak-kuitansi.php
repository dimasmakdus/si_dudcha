<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INV/<?= date("Ym", strtotime($tanggal)) . "/" . $kode_pemesanan ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/report.css">
</head>

<body>
    <table width="100%">
        <tr>
            <td width="390"><b style="font-size: 24px">DUDCHA</b></td>
        </tr>
        <tr>
            <td>Jl.Dipatiukur, Bandung</td>
        </tr>
        <tr>
            <td>HP. 0813-1232-12312</td>
        </tr>
    </table>
    <hr>
    <p>
        <i>Nomor : INV/<?= date("Ym", strtotime($tanggal)) . "/" . $kode_pemesanan ?></i>
    </p>
    <h3 align="center"><u>KUITANSI PEMBAYARAN</u></h3>
    <table width="100%" style="border-spacing: 15px">
        <tr>
            <td width="30%">Terima dari</td>
            <td width="5%">:</td>
            <td style="border-bottom: 1px solid"><?= $diterima ?></td>
        </tr>
        <tr>
            <td width="30%">Uang Sejumlah</td>
            <td width="5%">:</td>
            <td style="border-bottom: 1px solid"><?= $jumlah_uang_terbilang ?> Rupiah</td>
        </tr>
        <tr>
            <td width="30%">Untuk Pembayaran</td>
            <td width="5%">:</td>
            <td style="border-bottom: 1px solid"><?= $pembayaran ?></td>
        </tr>
    </table>
    <br><br><br>
    <table width="100%">
        <tr>
            <td></td>
            <td></td>
            <td>Bandung, <?= $tanggalWithBulan ?></td>
        </tr>
        <tr>
            <td width="35%"></td>
            <td>Bagian Keuangan,</td>
            <td></td>
        </tr>
        <tr style="line-height: 74px;">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>(<?= $bagian_keuangan ?>)</td>
            <td>(<?= $supplier ?>)</td>
        </tr>
    </table>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>