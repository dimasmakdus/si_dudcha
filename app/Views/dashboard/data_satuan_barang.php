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
                        <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Satuan</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Satuan</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data_satuan_barang as $satuan) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $satuan['satuan_barang_name'] ?></td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="top" title="Ubah">
                                                <a class="btn btn-sm bg-olive btn-edit-satuan" data-toggle="modal" data-target="#edit-<?= $satuan['satuan_barang_id'] ?>"><i class="fas fa-edit"></i></a>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="top" title="Hapus">
                                                <a class="btn btn-sm btn-danger btn-delete-satuan" data-toggle="modal" data-target="#hapus-<?= $satuan['satuan_barang_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-<?= $satuan['satuan_barang_id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin manghapus data ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= base_url('satuan-barang/remove') ?>/<?= $satuan['satuan_barang_id'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-<?= $satuan['satuan_barang_id'] ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="form-horizontal" action="<?= base_url('satuan-barang/update'); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Satuan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="satuan_barang_id" value="<?= $satuan['satuan_barang_id'] ?>">
                                                        <div class="form-group row">
                                                            <label for="nama-satuan" class="col-sm-2 col-form-label">Nama Satuan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="satuan_barang_name" id="satuan-barang-name" value="<?= $satuan['satuan_barang_name'] ?>" placeholder="Nama Satuan" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan</button>
                                                        <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->


                                    <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Modal Tambah -->
                <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="form-horizontal" action="<?= base_url('satuan-barang/create'); ?>" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Satuan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="nama-satuan" class="col-sm-2 col-form-label">Nama Satuan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="satuan_barang_name" id="satuan_barang_name" placeholder="Nama Satuan" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah Data</button>
                                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->

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