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
                                    <select class="form-control select2" name="status" id="status" onchange="changeStatus()" style="width: 100%;" required>
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php foreach ($status as $key => $value) : ?>
                                            <option value="<?= $key ?>" <?= $key == $proses['status'] ? 'selected' : '' ?>><?= $value ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div id="alasan-ditolak" style="display: <?= $proses['status'] == "cancel" ? "block" : "none" ?>;">
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Alasan Ditolak</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="keterangan" id="keterangan"><?= $proses['keterangan'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Detail Pemesanan</label>
                                <div class="col-sm-10">
                                    <table id="tbl_edit" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th class="text-center" style="width:8%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($data_barang as $barang) : ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id_detail[]" value="<?= $barang['id'] ?>">
                                                        <input type="hidden" name="kode_barang[]" value="<?= $barang['kode_barang'] ?>">
                                                        <input type="hidden" name="nama_barang[]" value="<?= $barang['nama_barang'] ?>">
                                                        <input type="hidden" name="satuan_barang_id[]" value="<?= $barang['satuan_barang_id'] ?>">
                                                        <input type="hidden" name="harga_beli[]" value="<?= $barang['harga_beli'] ?>">
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td><?= $barang['nama_barang'] ?></td>
                                                    <td><?= "Rp " . number_format($barang['harga_beli'], 0, ',', '.') ?></td>
                                                    <td width="180px">
                                                        <input type="number" class="form-control qty-stok" name="qty[]" value="<?= (!$barang['stok'] <= 0) ? $barang['stok'] : '' ?>">
                                                    </td>
                                                    <td><?= $barang['satuan_barang_name'] ?></td>
                                                    <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-barang">&#x1D5EB;</button></td>
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
    function changeStatus() {
        var value = document.getElementById('status').value

        if (value == 'cancel') {
            document.getElementById("alasan-ditolak").style.display = "block";
        } else {
            document.getElementById("alasan-ditolak").style.display = "none";
        }
    }
</script>
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

        var removeBarangBtn = document.getElementsByClassName('remove-barang');
        console.log(removeBarangBtn);
        for (var i = 0; i < removeBarangBtn.length; i++) {
            var button = removeBarangBtn[i];
            button.addEventListener('click', removeBarangItem)
        }
    }

    function removeBarangItem(e) {
        var buttonClick = e.target;
        buttonClick.parentElement.parentElement.remove();
    }

    function simpanPesanan(e) {
        e.preventDefault();
        var kode_supplier = $('select[name=kode_supplier] option').filter(':selected').val();
        var status = $('select[name=status] option').filter(':selected').val();

        var url = "<?= base_url('pesanan-barang/update'); ?>";
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
                            text: 'Pengajuan barang berhasil terkirim!',
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