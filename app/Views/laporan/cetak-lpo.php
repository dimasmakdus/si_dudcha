<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (isset($reqGet['periode'])) {
        $start_date = $reqGet["start_date"];
        $end_date = $reqGet["end_date"];
    ?>
        <title>LaporanPersediaan<?= date("d-m-Y", strtotime($start_date)) . " sd" . date("d-m-Y", strtotime($end_date)); ?></title>
    <?php } ?>

    <?php if (isset($reqGet['day'])) { ?>
        <title>LaporanPersediaan<?= date("d-m-Y", strtotime($reqGet['date'])); ?></title>
    <?php } ?>
</head>

<body>
    <?php if ($reqGet != []) : ?>
        <p>
            <center>
                <strong style="font-size:20px"><?= $titleHeader['judul'] ?></strong><br>
                <?= $titleHeader['alamat'] ?><br>
                <?= $titleHeader['telepon'] ?>
            </center>
        </p>
        <hr>
        <p>
            <center>
                <strong>LAPORAN PERSEDIAAN BARANG</strong><br>
                <?php if (isset($reqGet['periode'])) {
                    $start_date = $reqGet["start_date"];
                    $end_date = $reqGet["end_date"];
                ?>
                    Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
                <?php } ?>

                <?php if (isset($reqGet['day'])) { ?>
                    Tanggal : <?= $perTanggal ?>
                <?php } ?>
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
                        <th rowspan="2" style="vertical-align: middle;">Stok Awal</th>
                        <th colspan="2" style="vertical-align: middle;">Barang</th>
                        <th rowspan="2" style="vertical-align: middle;">Stok Akhir</th>
                    </tr>
                    <tr align="center">
                        <th>Masuk</th>
                        <th>Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php if (isset($getPeriode)) : ?>
                        <?php foreach ($getPeriode as $periode) : ?>
                            <tr>
                                <td align="center"><?= $i++ ?></td>
                                <td align="center"><?= $periode['kode_barang'] ?></td>
                                <td align="center"><?= $periode['nama_barang'] ?></td>
                                <td align="center"><?= $periode['satuan'] ?></td>
                                <td align="center"><?= $periode['stok_awal'] ?></td>
                                <td align="center"><?= $periode['stok_masuk'] ?></td>
                                <td align="center"><?= $periode['stok_keluar'] ?></td>
                                <td align="center"><?= $periode['stok_akhir'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?php if ($getPeriode == []) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="8" align="center">No data available in table</td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" align="center"><strong>Total</strong></td>
                            <td align="center"><strong><?= $total['awal'] ?></strong></td>
                            <td align="center"><strong><?= $total['masuk'] ?></strong></td>
                            <td align="center"><strong><?= $total['keluar'] ?></strong></td>
                            <td align="center"><strong><?= $total['akhir'] ?></strong></td>
                        </tr>
                    <?php } ?>
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
                    <td><?= $titleHeader['pimpinan'] ?></td>
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
        <?php endif ?>
        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
</body>

</html>