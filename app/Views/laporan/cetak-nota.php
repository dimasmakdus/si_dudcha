<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTA-<?= $penjualan['no_nota'] ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/report.css">
</head>

<body>
    <table width="100%">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td width="390"><b style="font-size: 24px"><?= $titleHeader['judul'] ?></b></td>
        </tr>
        <tr>
            <td width="220">No. Nota</td>
            <td width="30">:</td>
            <td><?= $penjualan['no_nota'] ?></td>
            <td></td>
            <td><?= $titleHeader['alamat'] ?></td>
        </tr>
        <tr>
            <td>Tanggal/ Waktu</td>
            <td>:</td>
            <td><?= date("d/m/Y H:i:s", strtotime($penjualan['tanggal'])) ?></td>
            <td></td>
            <td><?= $titleHeader['telepon'] ?></td>
        </tr>
    </table><br>
    <table class="tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $count = 1;

            foreach ($detailBarang as $detail) {
            ?>
                <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td><?= $detail['nama_barang'] ?></td>
                    <td align="right"><?= "Rp " . number_format($detail['harga_jual'], 0, ',', '.')  ?></td>
                    <td align="center"><?= $detail['jumlah'] ?></td>
                    <td align="center"><?= $detail['satuan_barang_name'] ?></td>
                    <td align="right"><?= "Rp " . number_format($detail['jumlah'] * $detail['harga_jual'], 0, ',', '.') ?></td>
                </tr>
            <?php } ?>

            <?php
            if ($count <= 10) {
            ?>
                <tr style="line-height: 180px;">
                    <td>&nbsp;</td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th align="right" colspan="5">Total :</th>
                <th align="right"><?= "Rp " . number_format($penjualan['total'], 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table><br><br><br>
    <table width="100%">
        <tr>
            <td width="35%"></td>
            <td>Tanda Terima,</td>
            <td>Hormat Kami,</td>
        </tr>
        <tr style="line-height: 74px;">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>______________</td>
            <td>(<?= $penjualan['sales'] ?>)</td>
        </tr>
    </table>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>