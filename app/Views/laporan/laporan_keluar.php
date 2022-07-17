<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tampilkan Laporan Barang Keluar</h5>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="form-group">
                            <label>Periode</label>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="start_date" class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                                <h5 class="mt-1"> s/d </h5>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="end_date" class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-olive" name="report">Tampilkan</button>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($reqGet['report'])) {
            $start_date = $reqGet["start_date"];
            $end_date = $reqGet["end_date"];
        ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="<?= base_url('cetak-lbk') . '?start_date=' . $start_date . '&end_date=' . $end_date . '&report=' ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                    <div class="card-body">
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
                                <strong>LAPORAN BARANG KELUAR</strong><br>
                                Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
                            </center>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                            <td valign="top" colspan="7" class="text-center">No data available in table</td>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th>Nama Barang</th>
                                            <th>Barang Terjual</th>
                                            <th>Total</th>
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
                            </div>
                            <br>
                            <table width="100%">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td width="20%">Bandung, <?= $today ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Mengetahui,</td>
                                </tr>
                                <tr>
                                    <td width="10%"></td>
                                    <td>Diserahkan Oleh</td>
                                    <td>Diterima Oleh</td>
                                    <td>Kepala Gudang</td>
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
                            </table><br><br>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        <?php } ?>
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>