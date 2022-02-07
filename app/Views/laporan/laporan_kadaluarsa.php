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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="<?= base_url('cetak-lkd') ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>

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
                                <strong>LAPORAN KADALUARSA OBAT</strong><br>
                                Tanggal : <?= $today ?>
                            </center>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th rowspan="2" style="vertical-align: middle;">No</th>
                                        <th rowspan="2" style="vertical-align: middle;">Kode Obat</th>
                                        <th rowspan="2" style="vertical-align: middle;">Nama Obat</th>
                                        <th rowspan="2" style="vertical-align: middle;">Satuan</th>
                                        <th rowspan="2" style="vertical-align: middle;">Tgl. Kadaluarsa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($kadaluarsa_obat) > 0) { ?>
                                        <?php $i = 1 ?>
                                        <?php foreach ($kadaluarsa_obat as $kd) : ?>
                                            <tr>
                                                <td align="center"><?= $i++ ?></td>
                                                <td align="center"><?= $kd['kode_obat'] ?></td>
                                                <td align="center"><?= $kd['nama_obat'] ?></td>
                                                <td align="center"><?= $kd['satuan'] ?></td>
                                                <td align="center"><?= $kd['tgl_kadaluarsa'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } else { ?>
                                        <tr class="odd">
                                            <td valign="top" colspan="8" class="text-center">No data available in table</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <?php if (count($kadaluarsa_obat) > 0) : ?>
                                        <tr>
                                            <td colspan="4" align="center"><strong>Jumlah Obat</strong></td>
                                            <td align="center"><strong><?= count($kadaluarsa_obat) ?></strong></td>
                                        </tr>
                                    <?php endif ?>
                                </tfoot>
                            </table><br>
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
                                    <td>Diterima Oleh</td>
                                    <td>Kepala Puskesmas</td>
                                    <td></td>
                                </tr>
                                <tr style="line-height: 74px;">
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>____________</td>
                                    <td>____________</td>
                                    <td>____________</td>
                                    <td></td>
                                </tr>
                            </table><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>