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
                        <h3 class="card-title">Kelola Data Obat-Obatan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url('obat-obatan/create'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_obat" id="kode-obat" placeholder="Kode Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama-obat" class="col-sm-2 col-form-label">Nama Obat *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_obat" id="nama-obat" placeholder="Nama Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis-obat" class="col-sm-2 col-form-label">Jenis Obat *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis_obat" id="jenis-obat" placeholder="Jenis Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dosis-aturan-obat" class="col-sm-2 col-form-label">Dosis Aturan Obat *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dosis_aturan_obat" id="dosis-aturan-obat" placeholder="Dosis Aturan Obat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-2 col-form-label">Satuan *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" required>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah Data</button>
                        <a href="<?= base_url('obat-obatan') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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