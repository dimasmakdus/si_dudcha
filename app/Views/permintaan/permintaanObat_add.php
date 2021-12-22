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
                        <form class="form-horizontal" action="<?= base_url('lplpo/create'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat *</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kode-stok-obat" id="kode-stok-obat" style="width: 100%;">
                                        <option value="" selected="selected">-- Cari Kode Obat --</option>
                                        <?php foreach ($kodeObat as $kode) : ?>
                                            <option value="<?= $kode['kode_obat'] ?>"><?= $kode['kode_obat'] ?> - <?= $kode['nama_obat'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="show-obat">
                                <div class="callout callout-info">
                                    <h5 class="mb-3">Detail Obat-Obatan :</h5>

                                    <div class="form-group row">
                                        <label for="nama-obat" class="col-sm-2 col-form-label">Kode Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="db-kode-obat" placeholder="Kode Obat" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama-obat" placeholder="Nama Obat" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis-obat" class="col-sm-2 col-form-label">Jenis Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jenis-obat" placeholder="Jenis Obat" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stok-awal" class="col-sm-2 col-form-label">Stok Awal</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="stok_awal" id="stok-awal" placeholder="Stok Awal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="penerimaan" class="col-sm-2 col-form-label">Penerimaan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="penerimaan" id="penerimaan" placeholder="Penerimaan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="persediaan" class="col-sm-2 col-form-label">Persediaan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="persediaan" id="persediaan" placeholder="Persediaan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pemakaian" class="col-sm-2 col-form-label">Pemakaian</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="pemakaian" id="pemakaian" placeholder="Pemakaian">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sisa_akhir" class="col-sm-2 col-form-label">Sisa Akhir</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="sisa_akhir" id="sisa_akhir" placeholder="Sisa Akhir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stok_optimum" class="col-sm-2 col-form-label">Stok Optimum</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="stok_optimum" id="stok_optimum" placeholder="Stok Optimum">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="permintaan" class="col-sm-2 col-form-label">Permintaan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="permintaan" id="permintaan" placeholder="Permintaan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pemberian" class="col-sm-2 col-form-label">Pemberian</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="pemberian" id="pemberian" placeholder="Pemberian">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="APBD/Lainnya" required>
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