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
                        <h3 class="card-title">Kelola Data Permintaan Obat</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url('pengeluaran-obat/create'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="no-terima-obat" class="col-sm-2 col-form-label">No Terima Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no-terima-obat" id="no-terima-obat" placeholder="No Terima Obat" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama-pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama-pasien" id="nama-pasien" placeholder="Nama Pasien">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama-obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama-obat" id="nama-obat" placeholder="Nama Obat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode-obat" id="kode-obat" placeholder="Kode Obat" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis-obat" class="col-sm-2 col-form-label">Jenis Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis-obat" id="jenis-obat" placeholder="Jenis Obat" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dosis-aturan-obat" class="col-sm-2 col-form-label">Dosis Aturan Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dosis-aturan-obat" id="dosis-aturan-obat" placeholder="Dosis Aturan Obat" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">
                                </div>
                            </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah Data</button>
                        <a href="<?= base_url('permintaan-obat') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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