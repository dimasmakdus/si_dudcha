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
                    <h5 class="card-title">Tampilkan Laporan Permintaan</h5>
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

        <?php if ($reqGet != []) : ?>
            <?php if (isset($reqGet['report'])) {
                $start_date = $reqGet["start_date"];
                $end_date = $reqGet["end_date"];
            ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-warning" href="<?= base_url('cetak-permintaan') . '?start_date=' . $start_date . '&end_date=' . $end_date . '&report=' ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>

                        </div>
                        <div class="card-body">
                            <table width="100%">
                                <tr align="center">
                                    <td><b style="font-size: 24px">DINAS KESEHATAN KABUPATEN BANDUNG</b></td>
                                </tr>
                                <tr align="center">
                                    <td><b style="font-size: 24px">PUSKESMAS CIMAUNG</b></td>
                                </tr>
                                <tr align="center">
                                    <td>Jl. Gunung Puntang Ds. Campakamulya, Kec. Cimaung</td>
                                </tr>
                            </table>
                            <hr>
                            <h4 align="center">PERMINTAAN BARANG</h4>
                            <p>Nomor Pemesanan : <?= $doc['kode_pesanan'] ?></p>
                            <p>Tanggal / Waktu : <?= $doc['tanggal'] ?></p>
                            <p>Supplier : <?= $doc['supplier'] ?></p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($pesanan == []) : ?>
                                        <tr class="odd">
                                            <td valign="top" colspan="5" class="text-center">No data available in table</td>
                                        </tr>
                                    <?php endif ?>
                                    <?php $i = 1 ?>
                                    <?php foreach ($pesanan as $data) : ?>
                                        <tr>
                                            <td align="center"><?= $i++ ?></td>
                                            <td align="center"><?= $data['kode_obat'] ?></td>
                                            <td><?= $data['nama_obat'] ?></td>
                                            <td align="center"><?= $data['jumlah'] ?></td>
                                            <td align="center"><?= $data['satuan'] ?></td>
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
                            </table><br><br>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            <?php } ?>
        <?php endif ?>
    </div>
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>