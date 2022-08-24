<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->include('templates/style') ?>

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
            <?php
            $db = \Config\Database::connect();
            $dayDate = isset($reqGet['day']) ? $reqGet['date'] : '';
            $getDate = isset($reqGet['periode']) ? "tanggal > '$start_date' AND tanggal < '$end_date'" : "tanggal >= '$dayDate 00:00:00' AND tanggal >= '$dayDate 59:59:59'";
            ?>
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
            <div class="row">
                <div class="col-md-6">
                    <label>Barang banyak diminati :</label>
                    <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Sebanyak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $brg = $db->query("SELECT tbl_barang.kode_barang, nama_barang, tanggal, SUM(stok_keluar) AS jumlah, satuan_barang_name AS satuan
                                                                FROM tbl_stok_barang 
                                                                INNER JOIN tbl_barang ON tbl_stok_barang.kode_barang = tbl_barang.kode_barang 
                                                                INNER JOIN tbl_satuan_barang ON tbl_barang.satuan = tbl_satuan_barang.satuan_barang_id
                                                                WHERE stok_keluar > 0 AND ($getDate)
                                                                GROUP BY nama_barang
                                                                ORDER BY jumlah DESC");

                            ?>
                            <?php if ($brg->getResult('array') == []) : ?>
                                <tr class="odd">
                                    <td valign="top" colspan="3" class="text-center">No data available in table</td>
                                </tr>
                            <?php endif ?>
                            <?php $i = 1 ?>
                            <?php foreach ($brg->getResult('array') as $row) : ?>
                                <tr align="center">
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['jumlah'] . " " . $row['satuan'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <label>Barang kurang diminati :</label>
                    <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Sebanyak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $brg = $db->query("SELECT tbl_barang.kode_barang, nama_barang, tanggal, SUM(stok_keluar) AS jumlah, satuan_barang_name AS satuan
                                                                FROM tbl_stok_barang 
                                                                INNER JOIN tbl_barang ON tbl_stok_barang.kode_barang = tbl_barang.kode_barang 
                                                                INNER JOIN tbl_satuan_barang ON tbl_barang.satuan = tbl_satuan_barang.satuan_barang_id
                                                                WHERE stok_keluar > 0 AND ($getDate)
                                                                GROUP BY nama_barang
                                                                ORDER BY jumlah ASC");

                            ?>
                            <?php if ($brg->getResult('array') == []) : ?>
                                <tr class="odd">
                                    <td valign="top" colspan="3" class="text-center">No data available in table</td>
                                </tr>
                            <?php endif ?>
                            <?php $i = 1 ?>
                            <?php foreach ($brg->getResult('array') as $row) : ?>
                                <tr align="center">
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['jumlah'] . " " . $row['satuan'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

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
                    <td></td>
                    <td><?= $titleHeader['pimpinan'] ?></td>
                </tr>
                <tr style="line-height: 74px;">
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>____________</td>
                    <td></td>
                    <td>____________</td>
                </tr>
            </table>
            <br><br><br>
        <?php endif ?>
        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
</body>

</html>