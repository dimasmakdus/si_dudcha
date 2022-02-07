<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporanBarangKeluar
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
                <strong>LAPORAN BARANG KELUAR</strong><br>
                Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
            </center>
        </p>
        <div class="table-responsive">
            <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>No Resep</th>
                        <th>Tanggal</th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $barang = $db->query("SELECT tbl_ambil_obat_detail.*, tbl_ambil_obat.kode_resep, tbl_ambil_obat.tanggal FROM tbl_ambil_obat_detail
                                                                LEFT JOIN tbl_ambil_obat ON tbl_ambil_obat_detail.id_transaksi = tbl_ambil_obat.id_transaksi
                                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                ORDER BY tanggal ASC");
                    $i = 1;
                    ?>
                    <?php foreach ($barang->getResult('array') as $data) : ?>
                        <tr>
                            <td align="center"><?= $i++ ?></td>
                            <td align="center"><?= "RP" . $data["kode_resep"] ?></td>
                            <td align="center"><?= date("d-m-Y", strtotime($data["tanggal"])) ?></td>
                            <td align=""><?= $data["nama_obat"] ?></td>
                            <td align="center"><?= $data["satuan"] ?></td>
                            <td align="right"><?= $data["jumlah"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?php if ($barang->getResult('array') == []) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="8" align="center">No data available in table</td>
                        </tr>
                    <?php } else { ?>
                        <?php
                        $hitung = $db->query("SELECT SUM(tbl_ambil_obat_detail.jumlah) jumlah, tbl_ambil_obat.tanggal FROM tbl_ambil_obat_detail
                                                                LEFT JOIN tbl_ambil_obat ON tbl_ambil_obat_detail.id_transaksi = tbl_ambil_obat.id_transaksi
                                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
                        ?>
                        <?php foreach ($hitung->getResult('array') as $total) : ?>
                            <tr>
                                <td colspan="5" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?= $total["jumlah"]; ?></strong></td>
                            </tr>
                        <?php endforeach ?>
                    <?php } ?>
                </tfoot>
            </table><br>
            <label for="">Keterangan :</label>
            <div class="col-md-6">
                <table width="70%" border="1" style="border-collapse:collapse; border-spacing:0">
                    <thead>
                        <tr align="center">
                            <th>Nama Obat</th>
                            <th>Jumlah Pengeluaran</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $brg = $db->query("SELECT tbl_ambil_obat_detail.nama_obat, SUM(tbl_ambil_obat_detail.jumlah) jumlah, tbl_ambil_obat.tanggal, tbl_ambil_obat_detail.satuan FROM tbl_ambil_obat_detail
                                                                    LEFT JOIN tbl_ambil_obat ON tbl_ambil_obat_detail.id_transaksi = tbl_ambil_obat.id_transaksi
                                                                    WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                    GROUP BY tbl_ambil_obat_detail.nama_obat");
                        ?>
                        <?php if ($brg->getResult('array') == []) : ?>
                            <tr class="odd">
                                <td valign="top" colspan="3" align="center">No data available in table</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($brg->getResult('array') as $row) : ?>
                            <tr>
                                <td><?= $row['nama_obat'] ?></td>
                                <td align="right"><?= $row['jumlah'] ?></td>
                                <td align="center"><?= $row['satuan'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <br><br><br>
                <table width="100%">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="30%">Bandung, <?= $today ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Mengetahui,</td>
                    </tr>
                    <tr>
                        <td width="10%"></td>
                        <td></td>
                        <td>Diserahkan Oleh</td>
                        <td>Diterima Oleh</td>
                        <td>Kepala Puskesmas</td>
                    </tr>
                    <tr style="line-height: 74px;">
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>____________</td>
                        <td>____________</td>
                        <td>____________</td>
                    </tr>
                </table>
            <?php } ?>
            <script type="text/javascript">
                window.addEventListener("load", window.print());
            </script>
</body>

</html>