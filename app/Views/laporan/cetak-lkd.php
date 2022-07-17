<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LaporanKadaluarsaBarang-<?= date("d-m-Y"); ?></title>
</head>

<body>
    <p>
        <center>
            <strong style="font-size:20px">DINAS KESEHATAN KABUPATEN BANDUNG</strong><br>
            <strong style="font-size:20px">PUSKESMAS CIMAUNG</strong><br>
            Jl. Gunung Puntang Ds. Campakamulya, Kec. Cimaung
        </center>
    </p>
    <hr>
    <p>
        <center>
            <strong>LAPORAN KADALUARSA OBAT</strong><br>
            Tanggal : <?= $today ?>
        </center>
    </p>
    <div class="table-responsive">
        <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
            <thead>
                <tr align="center">
                    <th rowspan="2" style="vertical-align: middle;">No</th>
                    <th rowspan="2" style="vertical-align: middle;">Kode Barang</th>
                    <th rowspan="2" style="vertical-align: middle;">Nama Barang</th>
                    <th rowspan="2" style="vertical-align: middle;">Satuan</th>
                    <th rowspan="2" style="vertical-align: middle;">Tgl. Kadaluarsa</th>
                    <th rowspan="2" style="vertical-align: middle;">Jumlah Barang</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($kadaluarsa_barang) > 0) { ?>
                    <?php $i = 1 ?>
                    <?php foreach ($kadaluarsa_barang as $kd) : ?>
                        <tr>
                            <td align="center"><?= $i++ ?></td>
                            <td align="center"><?= $kd['kode_barang'] ?></td>
                            <td align="center"><?= $kd['nama_barang'] ?></td>
                            <td align="center"><?= $kd['satuan'] ?></td>
                            <td align="center"><?= $kd['tgl_kadaluarsa'] ?></td>
                            <td align="center"><?= $kd['stok_masuk'] ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php } else { ?>
                    <tr class="odd">
                        <td valign="top" colspan="8" align="center">No data available in table</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php if (count($kadaluarsa_barang) > 0) : ?>
                    <tr>
                        <td colspan="5" align="center"><strong>Total Barang</strong></td>
                        <td align="center"><strong><?= $totalBarang ?></strong></td>
                    </tr>
                <?php endif ?>
            </tfoot>
        </table><br>

        <br><br><br>
        <table width="100%">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Bandung, <?= $today ?></td>
            </tr>
            <tr>
                <td width="10%"></td>
                <td>Diserahkan Oleh</td>
                <td>Diterima Oleh</td>
                <td>Kepala Puskesmas</td>
            </tr>
            <tr style="line-height: 74px;">
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td>____________</td>
                <td>____________</td>
                <td>____________</td>
            </tr>
        </table>
        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
</body>

</html>