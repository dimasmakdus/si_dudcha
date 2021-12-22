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
                        <form class="form-horizontal" action="<?= base_url('pengeluaran-harian/create'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="no-terima-obat" class="col-sm-2 col-form-label">No Terima Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no-terima-obat" placeholder="No Terima Obat" value="<?= $no_terima_obat ?>" disabled>
                                    <input type="hidden" name="no_terima_obat" value="<?= $no_terima_obat ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no-rekamedis" class="col-sm-2 col-form-label">No Rekamedis</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="no_rekamedis" id="no-rekamedis" style="width: 100%;" required>
                                        <option value="" selected="selected">-- Cari Rekamedis --</option>
                                        <?php foreach ($getPasien as $pasien) : ?>
                                            <option value="<?= $pasien['no_rekamedis'] ?>"><?= $pasien['no_rekamedis'] ?> - <?= $pasien['nama_pasien'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="show-pasien">
                                <div class="callout callout-info">
                                    <h5 class="mb-3">Detail Pasien :</h5>

                                    <div class="form-group row">
                                        <label for="no-rekamedis" class="col-sm-2 col-form-label">No Rekamedis</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="no-rekamedis-db" placeholder="No Rekamedis" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no-ktp" class="col-sm-2 col-form-label">No KTP</label>
                                        <div class="col-sm-10">
                                            <input type="nummber" class="form-control" id="no-ktp" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no-bpjs" class="col-sm-2 col-form-label">No BPJS</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="no-bpjs" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama-pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama-pasien" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status-pasien" class="col-sm-2 col-form-label">Status Pasien</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="status-pasien" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jenis-kelamin" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tempat-lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tempat-lahir" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl-lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tgl-lahir" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" row="3" id="alamat" placeholder="-" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode-obat" class="col-sm-2 col-form-label">Kode Obat</label>
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
                                    <div class="form-group row">
                                        <label for="dosis-obat" class="col-sm-2 col-form-label">Dosis Aturan Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dosis-obat" placeholder="Dosis Aturan Obat" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="satuan" placeholder="Satuan" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl-kadaluarsa" class="col-sm-2 col-form-label">Tanggal Kadaluarsa Obat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tgl-kadaluarsa" placeholder="Tanggal Kadaluarsa Obat" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" name="jumlah" placeholder="0" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan" required></textarea>
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