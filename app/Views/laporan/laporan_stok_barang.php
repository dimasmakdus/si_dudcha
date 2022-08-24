<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<?php $db = \Config\Database::connect(); ?>
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
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Filter per Tanggal</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="form-group">
                                <label>Hari</label>
                                <input type="date" name="date" class="form-control" value="<?php echo date("Y-m-d") ?>" autocomplete="off" required>
                            </div>
                            <button type="submit" class="btn bg-olive" name="day">Tampilkan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Filter per Periode</h3>
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
                            <button type="submit" class="btn bg-olive" name="periode">Tampilkan</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php if ($reqGet != []) : ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (isset($reqGet['periode'])) {
                                $start_date = $reqGet["start_date"];
                                $end_date = $reqGet["end_date"];
                            ?>
                                <a class="btn btn-warning" href="<?= base_url('cetak-lpo') . '?start_date=' . $start_date . '&end_date=' . $end_date . '&periode=' ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                            <?php } ?>

                            <?php if (isset($reqGet['day'])) { ?>
                                <a class="btn btn-warning" href="<?= base_url('cetak-lpo') . '?date=' . $reqGet['date'] . '&day=' ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                            <?php } ?>

                        </div>
                        <div class="card-body">
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
                                $dayDate = isset($reqGet['day']) ? $reqGet['date'] : '';
                                $getDate = isset($reqGet['periode']) ? "tanggal > '$start_date' AND tanggal < '$end_date'" : "tanggal >= '$dayDate 00:00:00' AND tanggal >= '$dayDate 59:59:59'";
                                ?>
                                <table class="table table-bordered">
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
                                        <?php if (isset($getPeriode)) : ?>
                                            <?php $i = 1 ?>
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
                                                <td valign="top" colspan="8" class="text-center">No data available in table</td>
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
                                        <label>Penjualan Terbanyak:</label>
                                        <table class="table table-bordered">
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
                                                    <tr>
                                                        <td align="center"><?= $i++ ?></td>
                                                        <td><?= $row['nama_barang'] ?></td>
                                                        <td><?= $row['jumlah'] . " " . $row['satuan'] ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Penjualan Tersedikit:</label>
                                        <table class="table table-bordered">
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
                                                    <tr>
                                                        <td align="center"><?= $i++ ?></td>
                                                        <td><?= $row['nama_barang'] ?></td>
                                                        <td><?= $row['jumlah'] . " " . $row['satuan'] ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <table width="100%">
                                    <tr>
                                        <td></td>
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
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="40%"></td>
                                        <td>Diserahkan Oleh</td>
                                        <td></td>
                                        <td><?= $titleHeader['pimpinan'] ?></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 74px;">
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>____________</td>
                                        <td></td>
                                        <td>____________</td>
                                        <td></td>
                                    </tr>
                                </table><br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            <?php endif ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>