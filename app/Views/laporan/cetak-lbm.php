<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporanBarangMasuk_<?= date("Ymd")  ?>
    </title>
    <?= $this->include('templates/style') ?>
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
                        <th>Nama Barang</th>
                        <th>Jumlah Pembelian</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $barang = $db->query("SELECT tbl_pembelian_detail.*, tbl_supplier.nama_supplier, tbl_barang.nama_barang, tbl_pembelian.total, tbl_pembelian.faktur, tbl_pembelian.tanggal
                                                FROM tbl_pembelian_detail
                                                LEFT JOIN tbl_barang ON tbl_pembelian_detail.kode_barang = tbl_barang.kode_barang
                                                LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                LEFT JOIN tbl_supplier ON tbl_pembelian.kode_supplier = tbl_supplier.kode_supplier
                                                WHERE tanggal > '$start_date' OR tanggal < '$end_date'
                                                ORDER BY tanggal ASC");

                    $totalHarga = 0;
                    $subTotal = 0;
                    $i = 1;
                    ?>
                    <?php foreach ($barang->getResult('array') as $row) : ?>
                        <tr>
                            <td align="center"><?= $i++ ?></td>
                            <td align="center"><?= $row['faktur'] ?></td>
                            <td align="center"><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
                            <td><?= $row['nama_supplier'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td align="right"><?= $row['stok_beli'] ?></td>
                            <td align="right"><?= "Rp " . number_format($row['harga_beli'], 0, ',', '.') ?></td>
                            <td align="right"><?= "Rp " . number_format($row['harga_beli'] * $row['stok_beli'], 0, ',', '.') ?></td>
                        </tr>
                        <?php $totalHarga = $totalHarga + $row['harga_beli'] ?>
                        <?php $subTotal = $subTotal + ($row['harga_beli'] * $row['stok_beli']) ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?php if ($barang->getResult('array') == []) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="8" class="text-center">No data available in table</td>
                        </tr>
                    <?php } else { ?>
                        <?php
                        $hitung = $db->query("SELECT SUM(tbl_pembelian_detail.stok_beli) qty, total, tbl_pembelian.tanggal
                                                FROM tbl_pembelian_detail
                                                LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                WHERE tanggal > '$start_date' OR tanggal < '$end_date'");
                        ?>
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
            <table width="100%" border="1" style="border-collapse:collapse; border-spacing:0">
                <thead>
                    <tr align="center">
                        <th>Nama Barang</th>
                        <th>Jumlah Pembelian</th>
                        <th>Nilai/Satuan</th>
                        <th>Jumlah Yang Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $brg = $db->query("SELECT SUM(tbl_pembelian_detail.stok_beli) stok_beli, SUM(tbl_pembelian_detail.stok_masuk) stok_masuk, tbl_pembelian_detail.stok_masuk, tbl_barang.nama_barang, tbl_barang.nilai_satuan, tbl_barang.satuan AS satuan_pemesanan, tbl_satuan_barang.satuan_barang_name, tbl_pembelian.total, tbl_pembelian.faktur, tbl_pembelian.tanggal
                                                        FROM tbl_pembelian_detail
                                                        LEFT JOIN tbl_satuan_barang ON tbl_satuan_barang.satuan_barang_id = tbl_pembelian_detail.satuan_barang_id
                                                        LEFT JOIN tbl_barang ON tbl_pembelian_detail.kode_barang = tbl_barang.kode_barang
                                                        LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                        WHERE tanggal > '$start_date' OR tanggal < '$end_date'
                                                        GROUP BY tbl_pembelian_detail.kode_barang");

                    ?>
                    <?php if ($brg->getResult('array') == []) : ?>
                        <tr class="odd">
                            <td valign="top" colspan="3" class="text-center">No data available in table</td>
                        </tr>
                    <?php endif ?>
                    <?php foreach ($brg->getResult('array') as $row) : ?>
                        <tr>
                            <td><?= $row['nama_barang'] ?></td>
                            <td align="right"><?= $row['stok_beli'] . " " . $row['satuan_barang_name'] ?></td>
                            <td align="right"><?= $row['nilai_satuan'] ?></td>
                            <td align="right">
                                <?php
                                $db      = \Config\Database::connect();
                                $builder = $db->table('tbl_satuan_barang')
                                    ->select('satuan_barang_name AS satuan_pemesanan')
                                    ->where('satuan_barang_id', $row['satuan_pemesanan'])
                                    ->get()->getResult('array')[0];
                                ?>
                                <?= $row['stok_masuk'] . " " . $builder['satuan_pemesanan'] ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <br><br><br>
            <table width="100%">
                <tr>
                    <td width="30%"></td>
                    <td>Diserahkan Oleh</td>
                    <td></td>
                    <td><?= $titleHeader['pimpinan'] ?></td>
                </tr>
                <tr style="line-height: 74px;">
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>________________</td>
                    <td></td>
                    <td>________________</td>
                </tr>
            </table>
        <?php } ?>
        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
</body>

</html>