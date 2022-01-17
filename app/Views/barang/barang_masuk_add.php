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
                    <li class="breadcrumb-item"><a href="<?= base_url('barang-masuk') ?>">Barang Masuk</a></li>
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
                        <h3 class="card-title"><?= $title ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" id="form-barang-masuk">
                            <?= csrf_field(); ?>
                            <?php if (isset($reqGet['no_faktur'])) {
                                $faktur = $reqGet['no_faktur'];
                            } else {
                                $faktur = "";
                            }
                            ?>
                            <div class="form-group row">
                                <label for="no_faktur" class="col-sm-2 col-form-label">Nomor Faktur</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_faktur" id="no-faktur" value="<?= $faktur ?>" placeholder="Masukkan nomor faktur" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <?php if (isset($reqGet['no_pesanan'])) {
                                    $noop = $reqGet['no_pesanan'];
                                } else {
                                    $noop = "";
                                }
                                ?>
                                <label for="data_pesanan" class="col-sm-2 col-form-label">Data Pemesanan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="data_pesanan" id="data_pesanan" style="width: 100%;">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php foreach ($permintaan as $no) : ?>
                                            <option value="<?= $no['no_pesanan'] ?>" <?= $no['no_pesanan'] == $noop ? 'selected' : '' ?>><?= $no['no_pesanan'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <?php if (isset($reqGet['no_pesanan'])) : ?>
                                <?php foreach ($permintaan as $data) : ?>
                                    <?php if ($reqGet['no_pesanan'] == $data['no_pesanan']) { ?>
                                        <div class="show-pesanan">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nomor Pemesanan</label>
                                                <div class="col-sm-10">
                                                    <h5 class="mt-1" id="no-faktur"><?= $data['no_pesanan'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama_supplier" class="col-sm-2 col-form-label">Supplier</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama_supplier" value="<?= $data['supplier'] ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="data_obat" class="col-sm-2 col-form-label">Detail Obat-Obatan</label>
                                                <div class="col-sm-10">
                                                    <table class="table table-bordered table-hover tbl-detail">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Obat</th>
                                                                <th>Satuan</th>
                                                                <th>Stok Pemesanan</th>
                                                                <th>Stok Masuk</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbl_body">
                                                            <?php $i = 1 ?>
                                                            <?php foreach ($detail_obat as $obat) : ?>
                                                                <?php if ($obat['no_pesanan'] == $reqGet['no_pesanan']) : ?>
                                                                    <tr>
                                                                        <td><?= $i++ ?></td>
                                                                        <td><?= $obat['nama_obat'] ?></td>
                                                                        <td><?= $obat['satuan'] ?></td>
                                                                        <td><?= $obat['stok'] ?></td>
                                                                        <td>
                                                                            <input type="number" class="form-control" nama="stok_masuk[]">
                                                                        </td>
                                                                    </tr>
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php endforeach ?>
                            <?php endif ?>
                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="button" class="btn bg-olive"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('barang-masuk') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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
<script>
    $('#data_pesanan').change(function() {
        <?php if (isset($permintaan)) : ?>
            var select_kode = $('select[name=data_pesanan] option').filter(':selected').val();
            var no_faktur = $('#no-faktur').val();
            window.location = "<?= base_url('barang-masuk-add') ?>?no_pesanan=" + select_kode + "&no_faktur=" + no_faktur;

        <?php endif ?>
    });
</script>
<script>
    $('#barang-masuk').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
</script>
<?= $this->endSection('content') ?>