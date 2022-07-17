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
                    <li class="breadcrumb-item"><a href="<?= base_url('pengajuan-barang') ?>">Pengajuan Barang</a></li>
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
                                    <select class="form-control select2" name="kode-supplier" id="kode-supplier" style="width: 100%;">
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
                                <label class="col-sm-2 col-form-label">Ajukan Barang</label>
                                <div class="col-sm-10">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th style="width: 15%;">Harga Beli (sebelumnya)</th>
                                                <th style="width: 20%;">Harga Beli (pengajuan)</th>
                                                <th style="width: 15%;">Jumlah Yang Diajukan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-barang">
                                            <?php foreach ($barang_kosong as $key => $kosong) : ?>
                                                <?php $idx = $key + 1 ?>
                                                <tr class="tr-row">
                                                    <td>
                                                        <select class="form-control select-barang" name="kode_barang[]" style="width: 100%;">
                                                            <option value="" selected="selected">-- Pilih Barang --</option>
                                                            <?php foreach ($data_barang as $barang) : ?>
                                                                <option value="<?= $barang['kode_barang'] ?>" <?= $barang['kode_barang'] == $kosong['kode_barang'] ? 'selected' : '' ?>><?= $barang['nama_barang'] ?> - Stok: <?= $barang['stok'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select-satuan" name="satuan_barang[]" style="width: 100%;">
                                                            <option value="" selected="selected">-- Pilih Satuan --</option>
                                                            <?php foreach ($satuan_barang as $satuan) : ?>
                                                                <option value="<?= $satuan['satuan_barang_id'] ?>"><?= $satuan['satuan_barang_name'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td class="harga-change"><?= "Rp " . number_format($kosong['harga_beli'], 0, ',', '.') ?></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" class="form-control harga-beli">
                                                            <input type="hidden" name="harga_beli[]" class="hargaBeliValue">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control stokBarang" name="stok[]">
                                                    </td>
                                                    <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-barang">&#x1D5EB;</button></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-success mb-2 btn-add-barang" type="button">&#65291; Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between">
                            <button type="submit" class="btn bg-olive save-barang"><i class="fas fa-save"></i> Simpan</button>
                            <a href="<?= base_url('pengajuan-barang') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
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
        var removeBarangBtn = document.getElementsByClassName('remove-barang');
        console.log(removeBarangBtn);
        for (var i = 0; i < removeBarangBtn.length; i++) {
            var button = removeBarangBtn[i];
            button.addEventListener('click', removeBarangItem)
        }

        var addBarangBtn = document.getElementsByClassName('btn-add-barang');
        for (var i = 0; i < addBarangBtn.length; i++) {
            var button = addBarangBtn[i];
            button.addEventListener('click', addToBarangClicked);
        }

        var selectBarang = document.getElementsByClassName('select-barang');
        for (var i = 0; i < selectBarang.length; i++) {
            var select = selectBarang[i];
            select.addEventListener('change', changeBarang);
        }

        var hargaBeli = document.getElementsByClassName('harga-beli');
        for (var i = 0; i < hargaBeli.length; i++) {
            var select = hargaBeli[i];
            console.log(select)
            select.addEventListener('keyup', keyUpHarga);
        }

        document.getElementsByClassName('save-barang')[0].addEventListener('click', simpanBarangClick);
    }

    function changeBarang(e) {
        var kodeBarang = e.target.value
        var kodeTarget = e.target
        var kodeElement = kodeTarget.parentElement.parentElement

        $.ajax({
            type: 'GET',
            url: '<?= base_url('data-barang-pesanan') ?>/' + kodeBarang,
            dataType: 'json',
            success: function(res) {
                kodeElement.getElementsByClassName('harga-change')[0].innerText = "Rp " + currencyChange(res.harga_beli)
            }
        });
    }

    function keyUpHarga(e) {
        var hargaElement = e.target;
        var hargaValue = hargaElement.value
        hargaElement.value = currencyChange(hargaValue.toString())

        var elementHarga = hargaElement.parentElement
        elementHarga.getElementsByClassName('hargaBeliValue')[0].value = hargaValue.split('.').join('');
    }

    function simpanBarangClick(e) {
        e.preventDefault();
        var kode_supplier = $('select[name=kode-supplier] option').filter(':selected').val();

        var url = "<?= base_url('pesanan-barang/create'); ?>";
        var form = $('#form-pengajuan').serialize()

        var valid = true
        if (kode_supplier != '') {
            var selectBarang = document.getElementsByClassName('select-barang');
            for (var i = 0; i < selectBarang.length; i++) {
                var rows = selectBarang[i].parentElement.parentElement
                var valSatuan = rows.getElementsByClassName('select-satuan')[0].value
                var valHarga = rows.getElementsByClassName('hargaBeliValue')[0].value
                var valStok = rows.getElementsByClassName('stokBarang')[0].value

                if (valStok == "") {
                    valid = false
                    Swal.fire(
                        'Tidak bisa!',
                        'Jumlah yang diajukan tidak boleh kosong!',
                        'error'
                    )
                }

                if (valHarga == "") {
                    valid = false
                    Swal.fire(
                        'Tidak bisa!',
                        'Harga beli pengajuan tidak boleh kosong!',
                        'error'
                    )
                }

                if (valSatuan == "") {
                    valid = false
                    Swal.fire(
                        'Tidak bisa!',
                        'Harap pilih satuan barang terlebih dahulu!',
                        'error'
                    )
                }
            }

            if (valid) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    success: function(res) {
                        if (res == "success") {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Pengajuan barang berhasil terkirim!',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "<?= base_url('pengajuan-barang') ?>";
                                }
                            })
                        } else if (res == 'empty_stok') {
                            Swal.fire(
                                'Tidak bisa!',
                                'Jumlah yang diajukan tidak boleh kosong!',
                                'error'
                            )
                        } else if (res = 'error') {
                            Swal.fire(
                                'Gagal!',
                                'Data gagal di kirim!',
                                'error'
                            )
                        }
                    },
                    error: function(error) {
                        Swal.fire(
                            'Gagal!',
                            'Data gagal di kirim!',
                            'error'
                        )
                    }
                });
            }
        } else {
            Swal.fire(
                'Tidak Bisa!',
                'Pilih supplier terlebih dahulu!',
                'error'
            )
        }

    }

    function removeBarangItem(e) {
        var buttonClick = e.target;
        buttonClick.parentElement.parentElement.remove();
    }

    function addToBarangClicked(e) {
        var addTr = document.createElement('tr');
        addTr.classList.add('tr-row');
        var tabel = document.getElementsByClassName('tbl-barang')[0];
        var barangRowContents =
            `<tr class="tr-row">
            <td>
                <select class="form-control select-barang" name="kode_barang[]" style="width: 100%;">
                    <option value="" selected="selected">-- Pilih Barang --</option>
                    <?php foreach ($data_barang as $barang) : ?>
                        <option value="<?= $barang['kode_barang'] ?>"><?= $barang['nama_barang'] ?> - Stok: <?= $barang['stok'] ?></option>
                    <?php endforeach ?>
                </select>
            </td>
            <td>
                <select class="form-control select-satuan" name="satuan_barang[]" style="width: 100%;">
                    <option value="" selected="selected">-- Pilih Satuan --</option>
                    <?php foreach ($satuan_barang as $satuan) : ?>
                        <option value="<?= $satuan['satuan_barang_id'] ?>"><?= $satuan['satuan_barang_name'] ?></option>
                    <?php endforeach ?>
                </select>
            </td>
            <td class="harga-change"><?= "Rp " . number_format($kosong['harga_beli'], 0, ',', '.') ?></td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control harga-beli">
                    <input type="hidden" name="harga_beli[]" class="hargaBeliValue">
                </div>
            </td>
            <td>
                <input type="number" class="form-control stokBarang" name="stok[]">
            </td>
            <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-barang">&#x1D5EB;</button></td>
        </tr>`
        addTr.innerHTML = barangRowContents;
        tabel.append(addTr);
        addTr.getElementsByClassName('remove-barang')[0].addEventListener('click', removeBarangItem);
    }
</script>

<?= $this->endSection('content') ?>