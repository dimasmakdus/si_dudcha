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
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>No Resep</th>
                                        <th>Tanggal</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Jumlah Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $barang = $db->query("SELECT tbl_resep_detail.*, tbl_resep.kode_resep, tbl_resep.tanggal FROM tbl_resep_detail
                                                                LEFT JOIN tbl_resep ON tbl_resep_detail.id_transaksi = tbl_resep.id_transaksi
                                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                ORDER BY tanggal ASC");
                                    $i = 1;
                                    ?>
                                    <?php foreach ($barang->getResult('array') as $data) : ?>
                                        <tr>
                                            <td align="center"><?= $i++ ?></td>
                                            <td align="center"><?= "RP" . $data["kode_resep"] ?></td>
                                            <td align="center"><?= date("d-m-Y", strtotime($data["tanggal"])) ?></td>
                                            <td><?= $data["nama_obat"] ?></td>
                                            <td align="center"><?= $data["satuan"] ?></td>
                                            <td align="right"><?= $data["jumlah"] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <?php if ($barang->getResult('array') == []) { ?>
                                        <tr class="odd">
                                            <td valign="top" colspan="8" class="text-center">No data available in table</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php
                                        $hitung = $db->query("SELECT SUM(tbl_resep_detail.jumlah) jumlah, tbl_resep.tanggal FROM tbl_resep_detail
                                                                LEFT JOIN tbl_resep ON tbl_resep_detail.id_transaksi = tbl_resep.id_transaksi
                                                                WHERE tanggal BETWEEN '$start_date' AND '$end_date' ");
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th>Nama Obat</th>
                                            <th>Jumlah Pengeluaran</th>
                                            <th>Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $brg = $db->query("SELECT tbl_resep_detail.nama_obat, SUM(tbl_resep_detail.jumlah) jumlah, tbl_resep.tanggal, tbl_resep_detail.satuan FROM tbl_resep_detail
                                                                    LEFT JOIN tbl_resep ON tbl_resep_detail.id_transaksi = tbl_resep.id_transaksi
                                                                    WHERE tanggal BETWEEN '$start_date' AND '$end_date'
                                                                    GROUP BY tbl_resep_detail.nama_obat");
                                        ?>
                                        <?php if ($brg->getResult('array') == []) : ?>
                                            <tr class="odd">
                                                <td valign="top" colspan="3" class="text-center">No data available in table</td>
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
                                    <td>Kepala Puskesmas</td>
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