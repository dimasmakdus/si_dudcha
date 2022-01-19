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
                        <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Dokter</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Induk Dokter</th>
                                    <th>Nama Dokter</th>
                                    <th>Poli</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data_dokter as $dokter) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $dokter['nid'] ?></td>
                                        <td><?= $dokter['nama_dokter'] ?></td>
                                        <td><?= $dokter['poli'] ?></td>
                                        <td><?= $dokter['jenis_kelamin'] ?></td>
                                        <td><?= date("d-m-Y", strtotime($dokter['tgl_lahir'])); ?></td>
                                        <td><?= $dokter['alamat'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm bg-olive btn-edit-dokter" data-toggle="modal" data-target="#edit-<?= $dokter['kode_dokter'] ?>"><i class="fas fa-edit"></i> Ubah</a>
                                            <a class="btn btn-sm btn-danger btn-delete-dokter" data-toggle="modal" data-target="#hapus-<?= $dokter['kode_dokter'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-<?= $dokter['kode_dokter'] ?>">
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
                                                    <a href="<?= base_url('data-dokter/remove') ?>/<?= $dokter['kode_dokter'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-<?= $dokter['kode_dokter'] ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="form-horizontal" action="<?= base_url('data-dokter/update'); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Dokter</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $dokter['kode_dokter'] ?>">
                                                        <div class="form-group row">
                                                            <label for="nama_dokter" class="col-sm-3 col-form-label">Nama Dokter</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="nama_dokter" value="<?= $dokter['nama_dokter'] ?>" placeholder="Nama Dokter" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nid" class="col-sm-3 col-form-label">Nomor Induk Dokter</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" class="form-control" name="nid" value="<?= $dokter['nid'] ?>" placeholder="00000000000" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control select2" name="jenis_kelamin" style="width: 100%;" required>
                                                                    <option value="" selected disabled>-- Jenis Kelamin --</option>
                                                                    <?php foreach ($jenis_kelamin as $kelamin) : ?>
                                                                        <option value="<?= $kelamin ?>" <?= $kelamin == $dokter['jenis_kelamin'] ? 'selected' : '' ?>><?= $kelamin ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" class="form-control" name="tgl_lahir" value="<?= date("Y-m-d", strtotime($dokter['tgl_lahir'])); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="poli" class="col-sm-3 col-form-label">Poli</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control select2" name="poli" style="width: 100%;" required>
                                                                    <option value="" selected disabled>-- Poli --</option>
                                                                    <?php foreach ($poli as $value) : ?>
                                                                        <option value="<?= $value ?>" <?= $value == $dokter['poli'] ? 'selected' : '' ?>><?= $value ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" row="3" name="alamat" placeholder="Alamat" required><?= $dokter['alamat'] ?></textarea>
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
                            <form class="form-horizontal" action="<?= base_url('data-dokter/create'); ?>" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Dokter</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="nama_dokter" class="col-sm-3 col-form-label">Nama Dokter</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_dokter" placeholder="Nama Dokter" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nid" class="col-sm-3 col-form-label">Nomor Induk Dokter</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="nid" placeholder="00000000000" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" name="jenis_kelamin" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Jenis Kelamin --</option>
                                                <?php foreach ($jenis_kelamin as $kelamin) : ?>
                                                    <option value="<?= $kelamin ?>"><?= $kelamin ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tgl_lahir" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="poli" class="col-sm-3 col-form-label">Poli</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" name="poli" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Poli --</option>
                                                <?php foreach ($poli as $value) : ?>
                                                    <option value="<?= $value ?>"><?= $value ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" row="3" name="alamat" placeholder="Alamat" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah</button>
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