<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporanBarangMasuk<br />
    </title>
</head>

<body>
    <?php if (isset($reqGet['report'])) {
        $start_date = $reqGet["start_date"];
        $end_date = $reqGet["end_date"];
    ?>
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
                <strong>LAPORAN BARANG MASUK</strong><br>
                Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
            </center>
        </p>
        <div class="table-responsive">
            <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Faktur</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Pembelian</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $barang = $db->query("SELECT tbl_pembelian_detail.*, tbl_supplier.nama_supplier, tbl_obat.nama_obat, tbl_pembelian.total, tbl_pembelian.faktur, tbl_pembelian.tanggal
                                                FROM tbl_pembelian_detail
                                                LEFT JOIN tbl_obat ON tbl_pembelian_detail.kode_obat = tbl_obat.kode_obat
                                                LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                LEFT JOIN tbl_supplier ON tbl_pembelian.kode_supplier = tbl_supplier.kode_supplier
                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                ORDER BY tanggal ASC");

                    $i = 1;
                    ?>
                    <?php foreach ($barang->getResult('array') as $row) : ?>
                        <tr>
                            <td align="center"><?= $i++ ?></td>
                            <td align="center"><?= $row['faktur'] ?></td>
                            <td align="center"><?= $row['tanggal'] ?></td>
                            <td align="center"><?= $row['nama_supplier'] ?></td>
                            <td align="center"><?= $row['nama_obat'] ?></td>
                            <td align="center"><?= $row['stok_masuk'] ?></td>
                            <td align="right"><?= "RP " . $row['harga_beli'] ?></td>
                            <td align="right"><?= "RP " . $row['total'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?php if ($barang->getResult('array') == []) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="8" align="center">No data available in table</td>
                        </tr>
                    <?php } else { ?>
                        <?php $hitung = $db->query("SELECT SUM(tbl_pembelian_detail.stok_masuk) qty, SUM(tbl_pembelian_detail.harga_beli) subtotal,SUM(tbl_pembelian_detail.harga_beli*tbl_pembelian_detail.stok_masuk) total, tbl_pembelian.tanggal
                                                FROM tbl_pembelian_detail
                                                LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'"); ?>
                        <?php foreach ($hitung->getResult('array') as $row) : ?>
                            <tr>
                                <td colspan="5" align="center"><strong>Total</strong></td>
                                <td align="center"><strong><?= $row['qty'] ?></strong></td>
                                <td align="right"><strong><?= $row['subtotal'] ?></strong></td>
                                <td align="right"><strong><?= $row['total'] ?></strong></td>
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
                            <th>Nama Obat</th>
                            <th>Jumlah Pembelian</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $brg = $db->query("SELECT SUM(tbl_pembelian_detail.stok_masuk) stok_masuk, tbl_obat.nama_obat, tbl_obat.satuan, tbl_pembelian.total, tbl_pembelian.faktur, tbl_pembelian.tanggal
                                                        FROM tbl_pembelian_detail
                                                        LEFT JOIN tbl_obat ON tbl_pembelian_detail.kode_obat = tbl_obat.kode_obat
                                                        LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                        WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                        GROUP BY tbl_pembelian_detail.kode_obat");
                        ?>
                        <?php if ($brg->getResult('array') == []) { ?>
                            <tr class="odd">
                                <td valign="top" colspan="8" align="center">No data available in table</td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($brg->getResult('array') as $row) : ?>
                            <tr>
                                <td align="center"><?= $row['nama_obat'] ?></td>
                                <td align="center"><?= $row['stok_masuk'] ?></td>
                                <td align="center"><?= $row['satuan'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <br><br><br>
                <table width="100%">
                    <tr>
                        <td width="80%"></td>
                        <td>Kepala Puskesmas,</td>
                    </tr>
                    <tr style="line-height: 74px;">
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>_______________</td>
                    </tr>
                </table>
            <?php } ?>
            <script type="text/javascript">
                window.addEventListener("load", window.print());
            </script>
</body>

</html>