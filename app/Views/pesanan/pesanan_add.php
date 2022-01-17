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
                    <li class="breadcrumb-item"><a href="<?= base_url('pengajuan-obat') ?>">Pengajuan Obat</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form id="form-pengajuan">
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
                                <label for="no_pesanan" class="col-sm-2 col-form-label">Nomor Pemesanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $no_pemesanan ?>" disabled>
                                    <input type="hidden" class="form-control" name="no_pesanan" value="<?= $no_pemesanan ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode-supplier" class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kode-supplier" id="kode-supplier" style="width: 100%;" required>
                                        <option value="" selected="selected" disabled>-- Cari Supplier --</option>
                                        <?php foreach ($data_supplier as $supplier) : ?>
                                            <option value="<?= $supplier['kode_supplier'] ?>"><?= $supplier['nama_supplier'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="show-supplier">
                                <div class="callout callout-info">
                                    <h5 class="mb-3">Detail Supplier :</h5>
                                    <div class="form-group row">
                                        <label for="nama-supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama-supplier" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no-telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no-telepon" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email-supplier" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email-supplier" placeholder="-" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat-supplier" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" row="3" id="alamat-supplier" placeholder="-" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Obat</label>
                                <div class="col-sm-10">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Obat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-obat">
                                            <tr class="tr-row">
                                                <td>
                                                    <select class="form-control select-obat" name="kode_obat[]" style="width: 100%;" required>
                                                        <option value="" selected="selected" disabled>-- Pilih Obat --</option>
                                                        <?php foreach ($obat_kosong as $kosong) : ?>
                                                            <option value="<?= $kosong['kode_obat'] ?>"><?= $kosong['kode_obat'] ?> - <?= $kosong['nama_obat'] ?> (<?= $kosong['satuan'] ?>) - Stok: <?= $kosong['stok'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </td>
                                                <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-obat">&#x1D5EB;</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-success mb-2 btn-add-obat">&#65291; Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between">
                            <button type="submit" class="btn bg-olive save-obat"><i class="fas fa-save"></i> Simpan</button>
                            <a href="<?= base_url('pengajuan-obat') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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
        var removeObatBtn = document.getElementsByClassName('remove-obat');
        console.log(removeObatBtn);
        for (var i = 0; i < removeObatBtn.length; i++) {
            var button = removeObatBtn[i];
            button.addEventListener('click', removeObatItem)
        }

        var addObatBtn = document.getElementsByClassName('btn-add-obat');
        for (var i = 0; i < addObatBtn.length; i++) {
            var button = addObatBtn[i];
            button.addEventListener('click', addToObatClicked);
        }

        document.getElementsByClassName('save-obat')[0].addEventListener('click', simpanObatClick);
    }

    function simpanObatClick(e) {
        e.preventDefault();
        var kode_supplier = $('select[name=kode-supplier] option').filter(':selected').val();

        var url = "<?= base_url('pesanan-obat/create'); ?>";
        var form = $('#form-pengajuan').serialize()

        if (kode_supplier != '') {
            $.ajax({
                type: "POST",
                url: url,
                data: form,
                success: function(res) {
                    if (res == "success") {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pengajuan obat berhasil terkirim!',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "<?= base_url('pengajuan-obat') ?>";
                            }
                        })
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Data gagal di simpan!',
                            'error'
                        )
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
        } else {
            Swal.fire(
                'Tidak Bisa!',
                'Pilih supplier terlebih dahulu!',
                'error'
            )
        }

    }

    function removeObatItem(e) {
        var buttonClick = e.target;
        buttonClick.parentElement.parentElement.remove();
    }

    function addToObatClicked(e) {
        var addTr = document.createElement('tr');
        addTr.classList.add('tr-row');
        var tabel = document.getElementsByClassName('tbl-obat')[0];
        var obatRowContents =
            `<tr class="tr-row">
                <td>
                    <select class="form-control select-obat" name="kode_obat[]" style="width: 100%;" required>
                        <option value="" selected="selected" disabled>-- Pilih Obat --</option>
                            <?php foreach ($obat_kosong as $kosong) : ?>
                                <option value="<?= $kosong['kode_obat'] ?>"><?= $kosong['kode_obat'] ?> - <?= $kosong['nama_obat'] ?> (<?= $kosong['satuan'] ?>) - Stok: <?= $kosong['stok'] ?></option>
                            <?php endforeach ?>
                    </select>
                </td>
                <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-obat">&#x1D5EB;</button></td>
            </tr>`
        addTr.innerHTML = obatRowContents;
        tabel.append(addTr);
        addTr.getElementsByClassName('remove-obat')[0].addEventListener('click', removeObatItem);
    }
</script>

<?= $this->endSection('content') ?>