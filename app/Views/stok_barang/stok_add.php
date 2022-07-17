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
                        <h3 class="card-title">Kelola Data Stok Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url("stok-barang/create"); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="jumlah-barang" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah-barang" placeholder="0" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode-barang" class="col-sm-2 col-form-label">Kode Barang</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kode-stok-barang" id="kode-stok-barang" style="width: 100%;">
                                        <option value="" selected="selected">-- Cari Kode Barang --</option>
                                        <?php foreach ($kodeBarang as $kode) : ?>
                                            <option value="<?= $kode['kode_barang'] ?>"><?= $kode['kode_barang'] ?> - <?= $kode['nama_barang'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="show-barang">
                                <div class="callout callout-info">
                                    <h5 class="mb-3">Detail Barang :</h5>

                                    <div class="form-group row">
                                        <label for="nama-barang" class="col-sm-2 col-form-label">Kode Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="db-kode-barang" placeholder="Kode Barang" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama-barang" placeholder="Nama Barang" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis-barang" class="col-sm-2 col-form-label">Jenis Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jenis-barang" placeholder="Jenis Barang" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dosis-barang" class="col-sm-2 col-form-label">Dosis Aturan Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dosis-barang" placeholder="Dosis Aturan Barang" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="satuan" placeholder="Satuan" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl-kadaluarsa" class="col-sm-2 col-form-label">Tanggal Kadaluarsa Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tgl-kadaluarsa" placeholder="Tanggal Kadaluarsa Barang" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah Stok</button>
                        <a href="<?= base_url('stok-barang') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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