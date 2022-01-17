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
                    <li class="breadcrumb-item"><a href="<?= base_url('cek-pesanan') ?>">Cek Pemesanan</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form id="form-pesanan">
    <?= csrf_field(); ?>
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
                            <div class="form-group row">
                                <label for="no_pesanan" class="col-sm-2 col-form-label">No Pemesanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_pesanan" value="<?= $proses['kode_pesanan'] ?>" disabled>
                                    <input type="hidden" name="id_pesanan" value="<?= $proses['id'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_pesanan" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <h5 class="mt-2"><?= $proses['tanggal'] ?></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_supplier" class="col-sm-2 col-form-label">Supplier Dituju</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kode_supplier" id="kode_supplier" style="width: 100%;" required>
                                        <option value="" selected="selected" disabled>-- Supplier --</option>
                                        <?php foreach ($data_supplier as $supplier) : ?>
                                            <option value="<?= $supplier['kode_supplier'] ?>" <?= $supplier['kode_supplier'] == $proses['kode_supplier'] ? 'selected' : '' ?>><?= $supplier['nama_supplier'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status Pengajuan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="status" id="status" style="width: 100%;" required>
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php foreach ($status as $key => $value) : ?>
                                            <option value="<?= $key ?>" <?= $key == $proses['status'] ? 'selected' : '' ?>><?= $value ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Detail Pemesanan</label>
                                <div class="col-sm-10">
                                    <table id="tbl_edit" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Obat</th>
                                                <th>Nama Obat</th>
                                                <th>Satuan</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($data_obat as $obat) : ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id_detail[]" value="<?= $obat['id'] ?>">
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td><?= $obat['kode_obat'] ?></td>
                                                    <td><?= $obat['nama_obat'] ?></td>
                                                    <td><?= $obat['satuan'] ?></td>
                                                    <td width="180px">
                                                        <input type="number" class="form-control qty-stok" name="qty[]" value="<?= (!$obat['stok'] <= 0) ? $obat['stok'] : '' ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between">
                            <button type="button" class="btn bg-olive save-detail"><i class="fas fa-save"></i> Simpan</button>
                            <a href="<?= base_url('cek-pesanan') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
</form>

<!-- /.content -->
<?= $this->include('templates/script') ?>
<script>
    if (document.readyState == 'loading') {
        document.addEventListener('DOMContentLoaded', ready);
    } else {
        ready();
    }

    function ready() {
        var qtyInputs = document.getElementsByClassName('cart-qty-input');
        for (var i = 0; i < qtyInputs.length; i++) {
            var input = qtyInputs[i];
            input.addEventListener('change', qtyChanged);
        }
        document.getElementsByClassName('save-detail')[0].addEventListener('click', simpanPesanan);
    }

    function simpanPesanan(e) {
        e.preventDefault();
        var kode_supplier = $('select[name=kode_supplier] option').filter(':selected').val();
        var status = $('select[name=status] option').filter(':selected').val();

        var url = "<?= base_url('pesanan-obat/update'); ?>";
        var form = $('#form-pesanan').serialize()
        $.ajax({
            type: "POST",
            url: url,
            data: form,
            success: function(res) {
                switch (res) {
                    case "success":
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pengajuan obat berhasil terkirim!',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "<?= base_url('cek-pesanan') ?>";
                            }
                        })
                        break;
                    case "empty_qty":
                        Swal.fire(
                            'Tidak Bisa!',
                            'Qty tidak boleh kosong!',
                            'error'
                        )
                        break;
                    case "error":
                        Swal.fire(
                            'Gagal!',
                            'Data gagal di simpan!',
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
</script>
<script>
    $('#tbl_edit').DataTable({
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