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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $card_title ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        if (session()->getFlashData('success')) {
                        ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i>
                                <?= session()->getFlashData('success') ?>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (session()->getFlashData('error')) {
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <?= session()->getFlashData('error') ?>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pemesanan</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Supplier Dituju</th>
                                    <th>Status Pemesanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($permintaan_obat as $permintaan) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $permintaan['kode_pesanan'] ?></td>
                                        <td><?= $permintaan['tanggal'] ?></td>
                                        <td>
                                            <?php foreach ($data_supplier as $supp) {
                                                if ($supp['kode_supplier'] == $permintaan['kode_supplier']) {
                                                    echo $supp['nama_supplier'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php switch ($permintaan['status']) {
                                                case 'waiting': ?>
                                                    <small class="badge badge-warning"><i class="far fa-clock"></i> Menunggu Persetujuan</small>
                                                    <?php break; ?>
                                                <?php
                                                case 'approved': ?>
                                                    <small class="badge badge-success"><i class="fas fa-check"></i> Disetujui</small>
                                                    <?php break; ?>
                                                <?php
                                                case 'cancel': ?>
                                                    <small class="badge badge-danger"><i class="fas fa-times"></i> Ditolak</small>
                                                    <?php break; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('cek-pesanan-edit') . "/" . $permintaan['id'] ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Ubah</a>
                                            <?php if ($permintaan['status'] == 'approved') { ?>
                                                <a href="<?= base_url('cetak-pesanan') . "/" . $permintaan['id'] ?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Cetak</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

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