<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<?php
if (session()->get('name') == "Administrator") {
    $judul = $title;
} else {
    $judul = "Riwayat Barang Masuk";
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $judul ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $judul ?></li>
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
                        <h3 class="card-title"><?= $judul ?></h3>
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
                        <?php if (session()->get('name') == "Administrator") : ?>
                            <a href="<?= base_url('barang-masuk-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah</a>
                        <?php endif ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Obat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($pembelian as $beli) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $beli['faktur'] ?></td>
                                        <td><?= $beli['tanggal'] ?></td>
                                        <td>
                                            <?php
                                            $data = $supplier->find($beli['kode_supplier']);
                                            echo $data['nama_supplier']
                                            ?>
                                        </td>
                                        <td><?= $beli['total'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#hapus-"><i class="fas fa-eye"></i> Lihat</a>
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