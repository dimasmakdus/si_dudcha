<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporanPermintaanObat<br />
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
                <strong>LAPORAN PERMINTAAN OBAT</strong><br>
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
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $barang = $db->query("SELECT tbl_permintaan_detail.*, tbl_supplier.nama_supplier, tbl_obat.nama_obat, tbl_permintaan.tanggal, tbl_permintaan.kode_pesanan
                                                                FROM tbl_permintaan_detail
                                                                LEFT JOIN tbl_obat ON tbl_permintaan_detail.kode_obat = tbl_obat.kode_obat
                                                                LEFT JOIN tbl_permintaan ON tbl_permintaan_detail.id_permintaan = tbl_permintaan.id
                                                                LEFT JOIN tbl_supplier ON tbl_permintaan.kode_supplier = tbl_supplier.kode_supplier
                                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                ORDER BY tanggal ASC");
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
                            <td><?= $data['nama_obat'] ?></td>
                            <td align="right"><?= $data['stok'] ?></td>
                        </tr>
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
                        $brg = $db->query("SELECT SUM(tbl_permintaan_detail.stok) stok, tbl_obat.nama_obat, tbl_obat.satuan, tbl_permintaan.total, tbl_permintaan.tanggal
                                                                    FROM tbl_permintaan_detail
                                                                    LEFT JOIN tbl_obat ON tbl_permintaan_detail.kode_obat = tbl_obat.kode_obat
                                                                    LEFT JOIN tbl_permintaan ON tbl_permintaan_detail.id_permintaan = tbl_permintaan.id
                                                                    WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                    GROUP BY tbl_permintaan_detail.kode_obat");
                        ?>
                        <?php if ($brg->getResult('array') == []) : ?>
                            <tr class="odd">
                                <td valign="top" colspan="3" class="text-center">No data available in table</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($brg->getResult('array') as $row) : ?>
                            <tr>
                                <td><?= $row['nama_obat'] ?></td>
                                <td align="right"><?= $row['stok'] ?></td>
                                <td align="center"><?= $row['satuan'] ?></td>
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
                        <td><b><u>Kepala Puskesmas</u></b></td>
                    </tr>
                </table>
            <?php } ?>
            <script type="text/javascript">
                window.addEventListener("load", window.print());
            </script>
</body>

</html>