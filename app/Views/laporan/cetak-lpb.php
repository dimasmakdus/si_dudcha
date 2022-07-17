<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporanPermintaanBarang_<?= date("Ymd") ?>
    </title>
</head>

<body>
    <?php if (isset($reqGet['report'])) {
        $start_date = $reqGet["start_date"];
        $end_date = $reqGet["end_date"];
    ?>
        <p>
            <center>
                <strong style="font-size:20px">DUDCHA</strong><br>
                Jl. Dipatiukur. Bandung<br>
                HP. 0813-2281-5963
            </center>
        </p>
        <hr>
        <p>
            <center>
                <strong>LAPORAN PENGAJUAN BARANG</strong><br>
                Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
            </center>
        </p>
        <div class="table-responsive">
            <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nomo Pemesanan</th>
                        <th>Tanggal</th>
                        <th>Supplier Yang Dituju</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Pengajuan</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $barang = $db->query("SELECT tbl_permintaan_detail.*, tbl_supplier.nama_supplier, tbl_barang.nama_barang, tbl_permintaan.tanggal, tbl_permintaan.kode_pesanan
                                                                FROM tbl_permintaan_detail
                                                                LEFT JOIN tbl_barang ON tbl_permintaan_detail.kode_barang = tbl_barang.kode_barang
                                                                LEFT JOIN tbl_permintaan ON tbl_permintaan_detail.id_permintaan = tbl_permintaan.id
                                                                LEFT JOIN tbl_supplier ON tbl_permintaan.kode_supplier = tbl_supplier.kode_supplier
                                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                ORDER BY tanggal ASC");
                    $totalHarga = 0;
                    $subTotal = 0;
                    ?>
                    <?php if ($barang->getResult('array') == []) : ?>
                        <tr class="odd">
                            <td valign="top" colspan="5" class="text-center">No data available in table</td>
                        </tr>
                    <?php endif ?>
                    <?php $i = 1 ?>
                    <?php foreach ($barang->getResult('array') as $data) : ?>
                        <tr>
                            <td align="center"><?= $i++ ?></td>
                            <td><?= $data['kode_pesanan'] ?></td>
                            <td><?= date("d-m-Y", strtotime($data["tanggal"])) ?></td>
                            <td><?= $data['nama_supplier'] ?></td>
                            <td><?= $data['nama_barang'] ?></td>
                            <td align="right"><?= $data['stok'] ?></td>
                            <td align="right"><?= "Rp " . number_format($data['harga_beli'], 0, ',', '.') ?></td>
                            <td align="right"><?= "Rp " . number_format($data['stok'] * $data['harga_beli'], 0, ',', '.') ?></td>
                        </tr>
                        <?php $totalHarga = $totalHarga + $data['harga_beli'] ?>
                        <?php $subTotal = $subTotal + ($data['stok'] * $data['harga_beli']) ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?php if ($barang->getResult('array') == []) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="8" class="text-center">No data available in table</td>
                        </tr>
                    <?php } else { ?>
                        <?php $hitung = $db->query("SELECT SUM(tbl_permintaan_detail.stok) qty, total, tbl_permintaan.tanggal
                                            FROM tbl_permintaan_detail
                                            LEFT JOIN tbl_permintaan ON tbl_permintaan_detail.id_permintaan = tbl_permintaan.id
                                            WHERE tanggal BETWEEN '$start_date' AND '$end_date'"); ?>
                        <?php foreach ($hitung->getResult('array') as $row) : ?>
                            <tr>
                                <td colspan="5" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?= $row['qty'] ?></strong></td>
                                <td align="right"><strong><?= "Rp " . number_format($totalHarga, 0, ',', '.') ?></strong></td>
                                <td align="right"><strong><?= "Rp " . number_format($subTotal, 0, ',', '.') ?></strong></td>
                            </tr>
                        <?php endforeach ?>
                    <?php } ?>
                </tfoot>
            </table><br>
            <label for="">Keterangan :</label>
            <div class="col-md-6">
                <table width="50%" border="1" style="border-collapse:collapse; border-spacing:0">
                    <thead>
                        <tr align="center">
                            <th>Nama Barang</th>
                            <th>Jumlah Pengajuan</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $brg = $db->query("SELECT SUM(tbl_permintaan_detail.stok) stok, tbl_barang.nama_barang, tbl_barang.satuan, tbl_permintaan.total, tbl_permintaan.tanggal, tbl_satuan_barang.satuan_barang_name
                                                                    FROM tbl_permintaan_detail
                                                                    LEFT JOIN tbl_barang ON tbl_permintaan_detail.kode_barang = tbl_barang.kode_barang
                                                                    LEFT JOIN tbl_permintaan ON tbl_permintaan_detail.id_permintaan = tbl_permintaan.id
                                                                    LEFT JOIN tbl_satuan_barang ON tbl_satuan_barang.satuan_barang_id = tbl_permintaan_detail.satuan_barang_id
                                                                    WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                    GROUP BY tbl_permintaan_detail.kode_barang");
                        ?>
                        <?php if ($brg->getResult('array') == []) : ?>
                            <tr class="odd">
                                <td valign="top" colspan="3" class="text-center">No data available in table</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($brg->getResult('array') as $row) : ?>
                            <tr>
                                <td><?= $row['nama_barang'] ?></td>
                                <td align="right"><?= $row['stok'] ?></td>
                                <td align="center"><?= $row['satuan_barang_name'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <br><br>
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
                        <td><b><u>Kepala Gudang</u></b></td>
                    </tr>
                </table>
            <?php } ?>
            <script type="text/javascript">
                window.addEventListener("load", window.print());
            </script>
</body>

</html>