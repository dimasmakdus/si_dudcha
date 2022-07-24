<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporanBarangKeluar_<?= date("Ymd") ?>
    </title>
</head>

<body>
    <?php if (isset($reqGet['report'])) {
        $start_date = $reqGet["start_date"];
        $end_date = $reqGet["end_date"];
    ?>
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
                <strong>LAPORAN BARANG KELUAR</strong><br>
                Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
            </center>
        </p>
        <div class="table-responsive">
            <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nota Barang</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <!-- <th>Harga Beli</th> -->
                        <th>Harga Jual</th>
                        <th>Barang Terjual</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $barang = $db->query("SELECT tbl_penjualan_barang_detail.*, tbl_penjualan_barang.no_nota, tbl_penjualan_barang.tanggal, tbl_satuan_barang.satuan_barang_name, tbl_barang.harga_beli FROM tbl_penjualan_barang_detail
                                                                LEFT JOIN tbl_penjualan_barang ON tbl_penjualan_barang_detail.id_transaksi = tbl_penjualan_barang.id_transaksi
                                                                LEFT JOIN tbl_satuan_barang ON tbl_penjualan_barang_detail.satuan = tbl_satuan_barang.satuan_barang_id
                                                                LEFT JOIN tbl_barang ON tbl_barang.kode_barang = tbl_penjualan_barang_detail.kode_barang
                                                                WHERE tanggal > '$start_date' OR tanggal < '$end_date'
                                                                ORDER BY tanggal ASC");
                    $totalHarga = 0;
                    $subTotal = 0;
                    $i = 1;
                    ?>
                    <?php foreach ($barang->getResult('array') as $data) : ?>
                        <tr>
                            <td align="center"><?= $i++ ?></td>
                            <td align="center"><?= $data["no_nota"] ?></td>
                            <td align="center"><?= date("d-m-Y", strtotime($data["tanggal"])) ?></td>
                            <td><?= $data["nama_barang"] ?></td>
                            <!-- <td align="right"><?= "Rp " . number_format($data["harga_beli"], 0, ',', '.') ?></td> -->
                            <td align="right"><?= "Rp " . number_format($data["harga_jual"], 0, ',', '.') ?></td>
                            <td align="right"><?= $data["jumlah"] ?></td>
                            <td align="right"><?= "Rp " . number_format(($data['harga_jual'] * $data['jumlah']), 0, ',', '.') ?></td>
                        </tr>
                        <?php $totalHarga = $totalHarga + $data["harga_jual"] ?>
                        <?php $subTotal = $subTotal + ($data['harga_jual'] * $data['jumlah']) ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?php if ($barang->getResult('array') == []) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="8" class="text-center">No data available in table</td>
                        </tr>
                    <?php } else { ?>
                        <?php
                        $hitung = $db->query("SELECT SUM(tbl_penjualan_barang_detail.jumlah) jumlah, tbl_penjualan_barang.tanggal FROM tbl_penjualan_barang_detail
                                                                LEFT JOIN tbl_penjualan_barang ON tbl_penjualan_barang_detail.id_transaksi = tbl_penjualan_barang.id_transaksi
                                                                WHERE tanggal > '$start_date' OR tanggal < '$end_date' ");
                        ?>
                        <?php foreach ($hitung->getResult('array') as $total) : ?>
                            <tr>
                                <td colspan="5" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?= $total["jumlah"]; ?></strong></td>
                                <td align="right"><strong><?= "Rp " . number_format($subTotal, 0, ',', '.')  ?></strong></td>
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
                            <th>Nama Barang</th>
                            <th>Barang Terjual</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $brg = $db->query("SELECT tbl_penjualan_barang_detail.nama_barang, SUM(tbl_penjualan_barang_detail.jumlah) jumlah,  SUM(tbl_penjualan_barang_detail.harga_jual * tbl_penjualan_barang_detail.jumlah) harga_jual, tbl_penjualan_barang.tanggal, tbl_penjualan_barang_detail.satuan FROM tbl_penjualan_barang_detail
                                                                    LEFT JOIN tbl_penjualan_barang ON tbl_penjualan_barang_detail.id_transaksi = tbl_penjualan_barang.id_transaksi
                                                                    WHERE tanggal > '$start_date' OR tanggal < '$end_date'
                                                                    GROUP BY tbl_penjualan_barang_detail.nama_barang");

                        ?>
                        <?php if ($brg->getResult('array') == []) : ?>
                            <tr class="odd">
                                <td valign="top" colspan="3" class="text-center">No data available in table</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($brg->getResult('array') as $row) : ?>
                            <tr>
                                <td><?= $row['nama_barang'] ?></td>
                                <td align="right"><?= $row['jumlah'] ?></td>
                                <td align="right"><?= "Rp " . number_format($row['harga_jual'], 0, ',', '.') ?></td>
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
                        <td>Kepala Gudang</td>
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