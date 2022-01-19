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
                        <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Supplier</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>No Telpon</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data_supplier as $supplier) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $supplier['nama_supplier'] ?></td>
                                        <td><?= $supplier['alamat'] ?></td>
                                        <td><?= $supplier['no_telpon'] ?></td>
                                        <td><?= $supplier['email'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm bg-olive btn-edit-supplier" data-toggle="modal" data-target="#edit-<?= $supplier['kode_supplier'] ?>"><i class="fas fa-edit"></i> Ubah</a>

                                            <a class="btn btn-sm btn-danger btn-delete-supplier" data-toggle="modal" data-target="#hapus-<?= $supplier['kode_supplier'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-<?= $supplier['kode_supplier'] ?>">
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
                                                    <a href="<?= base_url('supplier/remove') ?>/<?= $supplier['kode_supplier'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-<?= $supplier['kode_supplier'] ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="form-horizontal" action="<?= base_url('supplier/update'); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Supplier</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="kode_supplier" value="<?= $supplier['kode_supplier'] ?>">
                                                        <div class="form-group row">
                                                            <label for="nama-supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="nama_supplier" id="nama-supplier" value="<?= $supplier['nama_supplier'] ?>" placeholder="Nama Supplier" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email-supplier" class="col-sm-2 col-form-label">Email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" name="email" id="email-supplier" value="<?= $supplier['email'] ?>" placeholder="Email" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="no-telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control" name="no_telpon" id="no-telepon" value="<?= $supplier['no_telpon'] ?>" placeholder="No Telepon" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" row="3" name="alamat" id="alamat" placeholder="Alamat" required><?= $supplier['alamat'] ?></textarea>
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
                            <form class="form-horizontal" action="<?= base_url('supplier/create'); ?>" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Supplier</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="nama-supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_supplier" id="nama-supplier" placeholder="Nama Supplier" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email-supplier" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="email-supplier" placeholder="example@mail.com" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no-telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="no_telpon" id="no-telepon" placeholder="08xxxxxxxx" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" row="3" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
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