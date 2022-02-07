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
                        <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Obat</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Tgl. Kadaluarsa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($obat_obatan as $obat) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $obat['kode_obat'] ?></td>
                                        <td><?= $obat['nama_obat'] ?></td>
                                        <td><?= $obat['stok'] ?></td>
                                        <td><?= $obat['satuan'] ?></td>
                                        <td><?= $obat['tgl_kadaluarsa'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm bg-olive btn-edit-obat" data-toggle="modal" data-target="#edit-<?= $obat['kode_obat'] ?>"><i class="fas fa-edit"></i> Ubah</a>
                                            <a class="btn btn-sm btn-danger btn-delete-obat" data-toggle="modal" data-target="#hapus-<?= $obat['kode_obat'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-<?= $obat['kode_obat'] ?>">
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
                                                    <a href="<?= base_url('obat-obatan/delete') ?>/<?= $obat['kode_obat'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-<?= $obat['kode_obat'] ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="form-horizontal" action="<?= base_url('obat-obatan/update'); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Obat-Obatan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= csrf_field(); ?>
                                                        <div class="form-group row">
                                                            <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" value="<?= $obat['kode_obat'] ?>" required disabled>
                                                                <input type="hidden" name="kode_obat" value="<?= $obat['kode_obat'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama-obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="nama_obat" value="<?= $obat['nama_obat'] ?>" placeholder="Nama Obat" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jenis-satuan" class="col-sm-2 col-form-label">Satuan</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control select2" name="satuan" style="width: 100%;" required>
                                                                    <option value="" disabled>-- Pilih Satuan --</option>
                                                                    <?php foreach ($satuan as $value) : ?>
                                                                        <option value="<?= $value ?>" <?= $value == $obat['satuan'] ? 'selected' : '' ?>><?= $value ?></option>
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
                            <form class="form-horizontal" action="<?= base_url('obat-obatan/create'); ?>" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Obat-Obatan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?= "GFK" . $kode_obat_baru ?>" required disabled>
                                            <input type="hidden" class="form-control" name="kode_obat" value="<?= "GFK" . $kode_obat_baru ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_obat" placeholder="Nama Obat" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="satuan" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Pilih Satuan --</option>
                                                <?php foreach ($satuan as $value) : ?>
                                                    <option value="<?= $value ?>"><?= $value ?></option>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>