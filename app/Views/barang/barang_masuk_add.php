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
                                                <label for="data_barang" class="col-sm-12 col-form-label">Detail Barang :</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-hover tbl-detail">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Barang</th>
                                                                <th>Harga Beli</th>
                                                                <th>Satuan Beli</th>
                                                                <th>Stok Beli</th>
                                                                <th>Satuan di Gudang</th>
                                                                <th>Isi dalam kemasan</th>
                                                                <th>Stok Masuk</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbl_body">
                                                            <?php $i = 1 ?>
                                                            <?php foreach ($detail_barang as $key => $barang) : ?>
                                                                <?php if ($barang['no_pesanan'] == $reqGet['no_pesanan']) : ?>
                                                                    <input type="hidden" name="kode_barang[]" value="<?= $barang['kode_barang'] ?>">
                                                                    <input type="hidden" name="stok[]" value="<?= $barang['stok'] ?>">
                                                                    <tr>
                                                                        <td>
                                                                            <?= $i++ ?>
                                                                            <input type="hidden" name="harga_beli[]" id="hargaPesanan" value="<?= $barang['harga_beli'] ?>">
                                                                            <input type="hidden" name="satuan_beli[]" id="satuanPesanan" value="<?= $barang['satuan_id'] ?>">
                                                                        </td>
                                                                        <td><?= $barang['nama_barang'] ?></td>
                                                                        <td class="text-right"><?= "Rp " . number_format($barang['harga_beli'], 0, ',', '.') ?></td>
                                                                        <td><?= $barang['satuan'] ?></td>
                                                                        <td class="stokBarang"><?= $barang['stok'] ?></td>
                                                                        <td><?= $barang['satuan_digudang'] ?></td>
                                                                        <td>
                                                                            <!-- <input type="number" class="form-control input-nilai-satuan"> -->
                                                                            <?= $barang['nilai_satuan'] ?>
                                                                        </td>
                                                                        <td style="width: 10%;">
                                                                            <?php $stokMasuk = $barang['nilai_satuan'] * $barang['stok'] ?>
                                                                            <input type="hidden" name="stokMasuk[]" value="<?= $stokMasuk ?>">
                                                                            <?= $stokMasuk ?>
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
                    <?php if (isset($reqGet['no_pesanan'])) : ?>
                        <div class="card-footer justify-content-between">
                            <button type="button" onclick="simpanStok()" class="btn bg-olive"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    <?php endif ?>

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
    function keyUpHarga(idx) {
        var hargaElement = document.getElementById('keyupHarga-' + idx);
        var hargaValue = hargaElement.value
        hargaElement.value = currencyChange(hargaValue.toString())

        document.getElementById('hargaBeli-' + idx).value = hargaValue;
    }

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
            var validTable = true
            var hargaBeliInput = document.getElementsByClassName('harga-beli')
            for (var i = 0; i < hargaBeliInput.length; i++) {
                if (hargaBeliInput[i].value == "") {
                    validTable = false
                    Swal.fire(
                        'Tidak bisa!',
                        'Masukkan harga beli terlebih dahulu!',
                        'error'
                    )
                }
            }

            if (validTable) {
                var url = "<?= site_url('barang-masuk/create'); ?>";
                var form = $('#form-barang-masuk').serialize();
                console.log(form)

                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Pastikan Harga Beli sudah diisi. Lanjut proses ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form,
                            success: function(res) {
                                switch (res) {
                                    case 'success':
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Stok Barang berhasil di tambahkan!',
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
                    } else {
                        Swal.close();
                    }
                })
            }
        }

    }

    var inputNilai = document.getElementsByClassName('input-nilai-satuan');
    for (var i = 0; i < inputNilai.length; i++) {
        var input = inputNilai[i];
        input.addEventListener('keyup', changeNilaiSatuan);
    }

    function changeNilaiSatuan(e) {
        var keyupChange = e.target;
        var table = keyupChange.parentElement.parentElement
        var stok = table.getElementsByClassName('stokBarang')[0].innerText

        var totalStok = keyupChange.value * stok

        table.getElementsByClassName('stok-masuk')[0].value = totalStok
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