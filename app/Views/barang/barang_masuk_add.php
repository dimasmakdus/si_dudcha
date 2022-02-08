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
                        <form id="form-barang-masuk">
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
                                    <input type="text" class="form-control" name="no_faktur" id="no_faktur" value="<?= $faktur ?>" placeholder="Masukkan nomor faktur" required>
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
                                                    <h6 class="mt-2" id="no-faktur"><?= $data['no_pesanan'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama_supplier" class="col-sm-2 col-form-label">Supplier</label>
                                                <div class="col-sm-10">
                                                    <?php
                                                    $supp = $supplier->find($data['supplier'])
                                                    ?>
                                                    <input type="text" class="form-control" value="<?= $supp['nama_supplier'] ?>" disabled>
                                                    <input type="hidden" name="kode_supplier" value="<?= $supp['kode_supplier'] ?>">
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
                                                                <th>Stok Yang Diajukan</th>
                                                                <th>Stok Masuk</th>
                                                                <th>Tgl. Kadaluarsa</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbl_body">
                                                            <?php $i = 1 ?>
                                                            <?php foreach ($detail_obat as $obat) : ?>
                                                                <?php if ($obat['no_pesanan'] == $reqGet['no_pesanan']) : ?>
                                                                    <input type="hidden" name="kode_obat[]" value="<?= $obat['kode_obat'] ?>">
                                                                    <input type="hidden" name="stok[]" value="<?= $obat['stok'] ?>">
                                                                    <tr>
                                                                        <td><?= $i++ ?></td>
                                                                        <td><?= $obat['nama_obat'] ?></td>
                                                                        <td><?= $obat['satuan'] ?></td>
                                                                        <td><?= $obat['stok'] ?></td>
                                                                        <td>
                                                                            <input type="number" name="stokMasuk[]" class="form-control">
                                                                        </td>
                                                                        <td>
                                                                            <input type="date" class="form-control" name="tgl_kd[]">
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
                        </form>
                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="button" onclick="simpanStok()" class="btn bg-olive"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('barang-masuk') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                    </div>

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
        var select_kode = $('select[name=data_pesanan] option').filter(':selected').val();
        var no_faktur = $('#no_faktur').val();
        <?php if (isset($permintaan)) : ?>
            window.location = "<?= base_url('barang-masuk-add') ?>?no_pesanan=" + select_kode + "&no_faktur=" + no_faktur;

        <?php endif ?>
    });

    function simpanStok() {
        if ($('#no_faktur').val() == '') {
            Swal.fire(
                'Tidak Bisa!',
                'Input nomor faktur terlebih dahulu!',
                'error'
            )
        } else if ($('select[name=data_pesanan] option').filter(':selected').val() == '') {
            Swal.fire(
                'Tidak Bisa!',
                'Pilih data pemesanan terlebih dahulu!',
                'error'
            )
        } else {
            var url = "<?= site_url('barang-masuk/create'); ?>";
            var form = $('#form-barang-masuk').serialize();
            console.log(form);
            $.ajax({
                type: "POST",
                url: url,
                data: form,
                success: function(res) {
                    switch (res) {
                        case 'success':
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Stok Obat berhasil di tambahkan!',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "<?= base_url('barang-masuk') ?>";
                                }
                            })
                            break;
                        case 'over_stok':
                            Swal.fire(
                                'Tidak Bisa!',
                                'Input stok masuk tidak boleh melebihi yang diajukan!',
                                'error'
                            )
                            break;
                        case 'empty_qty':
                            Swal.fire(
                                'Tidak Bisa!',
                                'Input stok masuk terlebih dahulu!',
                                'error'
                            )
                            break;
                    }
                },
                error: function(error) {
                    Swal.fire(
                        'Gagal!',
                        'Data gagal di simpan!',
                        'error'
                    )
                }
            });
        }

    }
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