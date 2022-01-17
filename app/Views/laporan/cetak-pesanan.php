<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSN-<?= $laporan['tanggal'] ?></title>
</head>

<body>
    <table width="100%">
        <tr align="center">
            <td><b style="font-size: 24px">DINAS KESEHATAN KABUPATEN BANDUNG</b></td>
        </tr>
        <tr align="center">
            <td><b style="font-size: 24px">PUSKESMAS CIMAUNG</b></td>
        </tr>
        <tr align="center">
            <td>Jl. Gunung Puntang Ds. Campakamulya, Kec. Cimaung</td>
        </tr>
    </table>
    <hr>
    <h4 align="center">PERMINTAAN BARANG</h4>
    <p>Nomor Pemesanan : <?= $laporan['kode_pesanan'] ?></p>
    <p>Tanggal / Waktu : <?= $laporan['tanggal'] ?></p>
    <p>Supplier : <?= $laporan['supplier'] ?></p>
    <table width="100%" border="1px" style="border-collapse:collapse;border-spacing:0">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data_pesanan == []) : ?>
                <tr class="odd">
                    <td valign="top" colspan="5" align="center">No data available in table</td>
                </tr>
            <?php endif ?>
            <?php $i = 1 ?>
            <?php foreach ($data_pesanan as $data) : ?>
                <tr>
                    <td align="center"><?= $i++ ?></td>
                    <td align="center"><?= $data['kode_obat'] ?></td>
                    <td><?= $data['nama_obat'] ?></td>
                    <td align="center"><?= $data['jumlah'] ?></td>
                    <td align="center"><?= $data['satuan'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table><br><br><br>
    <table width="100%">
        <tr>
            <td></td>
            <td>Bandung, <?= $today ?></td>
        </tr>
        <tr>
            <td width="75%"></td>
            <td>Pimpinan,</td>
        </tr>
        <tr style="line-height: 74px;">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td><b><u>Kepala Puskesmas</u></b></td>
        </tr>
    </table>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>