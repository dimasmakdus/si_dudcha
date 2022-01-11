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
                        <h3 class="card-title">Kelola Data Supplier</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url('supplier/update'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="kode-supplier" class="col-sm-2 col-form-label">Kode Supplier</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_supplier" id="kode-supplier" value="<?= $getSupplier['kode_supplier'] ?>" required disabled>
                                    <input type="hidden" value="<?= $getSupplier['kode_supplier'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama-supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_supplier" id="nama-supplier" value="<?= $getSupplier['nama_supplier'] ?>" placeholder="Nama Supplier" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-supplier" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email-supplier" value="<?= $getSupplier['email'] ?>" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" row="3" name="alamat" id="alamat" placeholder="Alamat" required><?= $getSupplier['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no-telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="no_telpon" id="no-telepon" value="<?= $getSupplier['no_telpon'] ?>" placeholder="No Telepon" required>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan Data</button>
                        <a href="<?= base_url('supplier') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>