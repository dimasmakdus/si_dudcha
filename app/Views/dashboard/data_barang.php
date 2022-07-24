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
                        <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Barang</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Stok Minimum</th>
                                    <th>Satuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data_barang as $barang) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $barang['kode_barang'] ?></td>
                                        <td><?= $barang['nama_barang'] ?></td>
                                        <td><?= $barang['jenis_barang_name'] ?></td>
                                        <td><?= "Rp " . number_format($barang['harga_jual'], 0, ',', '.') ?></td>
                                        <td><?= $barang['stok'] ?></td>
                                        <td><?= $barang['stok_minimum'] ?></td>
                                        <td><?= $barang['satuan_barang_name'] ?></td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="top" title="Ubah">
                                                <a class="btn btn-sm bg-olive btn-edit-barang" data-toggle="modal" data-target="#edit-<?= $barang['kode_barang'] ?>"><i class="fas fa-edit"></i></a>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="top" title="Hapus">
                                                <a class="btn btn-sm btn-danger btn-delete-barang" data-toggle="modal" data-target="#hapus-<?= $barang['kode_barang'] ?>"><i class="fas fa-trash-alt"></i></a>
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus-<?= $barang['kode_barang'] ?>">
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
                                                    <a href="<?= base_url('data-barang/delete') ?>/<?= $barang['kode_barang'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-<?= $barang['kode_barang'] ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <form class="form-horizontal" action="<?= base_url('data-barang/update'); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body px-4">
                                                        <?= csrf_field(); ?>
                                                        <div class="form-group row">
                                                            <label for="kode-barang" class="col-sm-2 col-form-label">Kode Barang</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" value="<?= $barang['kode_barang'] ?>" required disabled>
                                                                <input type="hidden" name="kode_barang" value="<?= $barang['kode_barang'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="nama_barang" value="<?= $barang['nama_barang'] ?>" placeholder="Nama Barang" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jenis-satuan" class="col-sm-2 col-form-label">Jenis Barang</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control select2" name="jenis_barang" style="width: 100%;" required>
                                                                    <option value="" disabled>-- Pilih Jenis Barang --</option>
                                                                    <?php foreach ($jenis_barang as $jenis) : ?>
                                                                        <option value="<?= $jenis['jenis_barang_id'] ?>" <?= $jenis['jenis_barang_id'] == $barang['jenis_barang'] ? 'selected' : '' ?>><?= $jenis['jenis_barang_name'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="satuan" class="col-sm-2 col-form-label">Stok Minimum</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control" name="stok_minimum" value="<?= $barang['stok_minimum'] ?>" placeholder="0" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jenis-satuan" class="col-sm-2 col-form-label">Satuan Beli</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control select2" name="satuan_beli" style="width: 100%;" required>
                                                                    <option value="" disabled>-- Pilih Satuan Beli --</option>
                                                                    <?php foreach ($satuan as $value) : ?>
                                                                        <option value="<?= $value['satuan_barang_id'] ?>" <?= $value['satuan_barang_id'] == $barang['satuan_beli'] ? 'selected' : '' ?>><?= $value['satuan_barang_name'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="satuan" class="col-sm-2 col-form-label">Isi dalam kemasan</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" name="nilai_satuan" value="<?= $barang['nilai_satuan'] ?>" placeholder="0" required>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">dari satuan beli</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jenis-satuan" class="col-sm-2 col-form-label">Satuan Jual</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control select2" name="satuan" style="width: 100%;" required>
                                                                    <option value="" disabled>-- Pilih Satuan Jual --</option>
                                                                    <?php foreach ($satuan as $value) : ?>
                                                                        <option value="<?= $value['satuan_barang_id'] ?>" <?= $value['satuan_barang_id'] == $barang['satuan'] ? 'selected' : '' ?>><?= $value['satuan_barang_name'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama-barang" class="col-sm-2 col-form-label">Harga Beli</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="text" name="harga_beli" class="form-control" value="<?= $barang['harga_beli'] ?>" placeholder="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama-barang" class="col-sm-2 col-form-label">Harga Jual</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="text" name="harga_jual" class="form-control" value="<?= $barang['harga_jual'] ?>" placeholder="" required>
                                                                </div>
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
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form class="form-horizontal" action="<?= base_url('data-barang/create'); ?>" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="kode-barang" class="col-sm-2 col-form-label">Kode Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?= "BRG" . $kode_barang_baru ?>" required disabled>
                                            <input type="hidden" class="form-control" name="kode_barang" value="<?= "BRG" . $kode_barang_baru ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis-satuan" class="col-sm-2 col-form-label">Jenis Barang</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="jenis_barang" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Pilih Jenis Barang --</option>
                                                <?php foreach ($jenis_barang as $jenis) : ?>
                                                    <option value="<?= $jenis['jenis_barang_id'] ?>"><?= $jenis['jenis_barang_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satuan" class="col-sm-2 col-form-label">Stok Minimum</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="stok_minimum" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis-satuan" class="col-sm-2 col-form-label">Satuan Beli</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="satuan_beli" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Pilih Satuan Beli --</option>
                                                <?php foreach ($satuan as $value) : ?>
                                                    <option value="<?= $value['satuan_barang_id'] ?>"><?= $value['satuan_barang_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satuan" class="col-sm-2 col-form-label">Isi dalam kemasan</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="nilai_satuan" placeholder="0" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">dari satuan beli</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis-satuan" class="col-sm-2 col-form-label">Satuan Jual</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="satuan" style="width: 100%;" required>
                                                <option value="" selected disabled>-- Pilih Satuan Jual --</option>
                                                <?php foreach ($satuan as $value) : ?>
                                                    <option value="<?= $value['satuan_barang_id'] ?>"><?= $value['satuan_barang_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-barang" class="col-sm-2 col-form-label">Harga Beli</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="harga_beli" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-barang" class="col-sm-2 col-form-label">Harga Jual</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="harga_jual" class="form-control" placeholder="" required>
                                            </div>
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