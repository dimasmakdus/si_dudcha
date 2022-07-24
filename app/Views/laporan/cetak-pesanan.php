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
            <td><b style="font-size: 24px"><?= $titleHeader['judul'] ?></b></td>
        </tr>
        <tr align="center">
            <td><?= $titleHeader['alamat'] ?></td>
        </tr>
        <tr align="center">
            <td><?= $titleHeader['telepon'] ?></td>
        </tr>
    </table>
    <hr>
    <h4 align="center">PEMESANAN BARANG</h4>
    <p>Nomor Pemesanan : <?= $laporan['kode_pesanan'] ?></p>
    <p>Tanggal / Waktu : <?= date("d/m/Y H:i:s", strtotime($laporan['tanggal'])) ?></p>
    <p>Supplier : <?= $laporan['supplier'] ?></p>
    <table width="100%" border="1px" style="border-collapse:collapse;border-spacing:0">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data_pesanan == []) : ?>
                <tr class="odd">
                    <td valign="top" colspan="5" align="center">No data available in table</td>
                </tr>
            <?php endif ?>
            <?php $i = 1;
            $total = 0;
            ?>
            <?php foreach ($data_pesanan as $data) : ?>
                <tr>
                    <td align="center"><?= $i++ ?></td>
                    <td align="center"><?= $data['kode_barang'] ?></td>
                    <td><?= $data['nama_barang'] ?></td>
                    <td align="right"><?= "Rp " . number_format($data['harga_beli'], 0, ',', '.') ?></td>
                    <td align="center"><?= $data['stok'] ?></td>
                    <td align="center"><?= $data['satuan_barang_name'] ?></td>
                    <td align="right"><?= "Rp " . number_format(($data['harga_beli'] * $data['stok']), 0, ',', '.') ?></td>
                </tr>
                <?php $total = $total + ($data['stok'] * $data['harga_beli']) ?>
            <?php endforeach ?>
            <tr>
                <td colspan="6" align="right"><strong>Total :</strong></td>
                <td align="right"><?= "Rp " . number_format($total, 0, ',', '.') ?></td>
            </tr>
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
            <td><b><u>Pimpinan</u></b></td>
        </tr>
    </table>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>