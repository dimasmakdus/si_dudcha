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
                        <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dosis Pemakaian Barang</th>
                                    <th>Khusus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($aturan_barang as $aturan) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $aturan['dosis_aturan_barang'] ?></td>
                                        <td><?= $aturan['khusus'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm bg-olive btn-edit-aturan" data-toggle="modal" data-target="#edit-<?= $aturan['id'] ?>"><i class="fas fa-edit"></i> Ubah</a>
                                            <a class="btn btn-sm btn-danger btn-edit-aturan" data-toggle="modal" data-target="#hapus-<?= $aturan['id'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-<?= $aturan['id'] ?>">
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
                                                    <a href="<?= base_url('aturan-barang/remove') ?>/<?= $aturan['id'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-<?= $aturan['id'] ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="form-horizontal" action="<?= base_url('aturan-barang/update'); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Aturan Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $aturan['id'] ?>">
                                                        <div class="form-group row">
                                                            <label for="dosis_aturan_barang" class="col-sm-3 col-form-label">Dosis Aturan Barang</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="dosis_aturan_barang" value="<?= $aturan['dosis_aturan_barang'] ?>" placeholder="Dosis Aturan Barang" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="khusus" class="col-sm-3 col-form-label">Khusus</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control select2" name="khusus" style="width: 100%;" required>
                                                                    <option value="" disabled>-- Bayi/Anak/Dewasa --</option>
                                                                    <?php foreach ($aturan_usia as $usia) : ?>
                                                                        <option value="<?= $usia ?>" <?= $aturan['khusus'] == $usia ? 'selected' : '' ?>><?= $usia ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
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
                            <form class="form-horizontal" action="<?= base_url('aturan-barang/create'); ?>" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Aturan Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="dosis_aturan_barang" class="col-sm-3 col-form-label">Dosis Aturan Barang</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="dosis_aturan_barang" placeholder="Dosis Aturan Barang" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="khusus" class="col-sm-3 col-form-label">Khusus</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" name="khusus" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Bayi/Anak/Dewasa --</option>
                                                <?php foreach ($aturan_usia as $usia) : ?>
                                                    <option value="<?= $usia ?>"><?= $usia ?></option>
                                                <?php endforeach ?>
                                            </select>
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