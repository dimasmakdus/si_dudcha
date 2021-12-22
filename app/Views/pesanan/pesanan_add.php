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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
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
                        <h3 class="card-title">Kelola Resep Obat</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url("pesanan-obat/create"); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode-obat" name="kode_obat" placeholder="Kode Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama-obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama-obat" name="nama_obat" placeholder="Nama Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis-obat" class="col-sm-2 col-form-label">Jenis Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jenis-obat" name="jenis_obat" placeholder="Jenis Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="0" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode-supplier" class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kode-supplier" id="kode-supplier" style="width: 100%;" required>
                                        <option value="" selected="selected">-- Cari Supplier --</option>
                                        <?php foreach ($data_supplier as $supplier) : ?>
                                            <option value="<?= $supplier['kode_supplier'] ?>"><?= $supplier['kode_supplier'] ?> - <?= $supplier['nama_supplier'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="show-supplier">
                                <div class="callout callout-info">
                                    <h5 class="mb-3">Detail Supplier :</h5>

                                    <div class="form-group row">
                                        <label for="kode-supplier-db" class="col-sm-2 col-form-label">Kode Supplier</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="kode-supplier-db" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama-supplier" name="nama-supplier" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no-telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no-telepon" name="no-telepon" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email-supplier" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email-supplier" name="email-supplier" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat-supplier" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" row="3" id="alamat-supplier" name="alamat-supplier" placeholder="-" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah Stok</button>
                        <a href="<?= base_url('resep-obat') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                    </div>
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>

<!-- /.content -->
<?= $this->endSection('content') ?>