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
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form id="formResep">
    <?= csrf_field(); ?>
    <input type="hidden" id="maxId" value="<?= $maxId ?>">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $card_title ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="no-resep" class="col-sm-2 col-form-label">Data Resep Pasien</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="no_resep" id="no-resep" style="width: 100%;">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php foreach ($resep_pasien as $pasien) : ?>
                                            <option value="<?= $pasien['no_resep'] ?>"><?= "RP" . $pasien['no_resep'] ?> - <?= $pasien['nama_pasien'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="show-pasien">
                                <div class="form-group row">
                                    <label for="no_resep" class="col-sm-2 col-form-label">Nomor Resep</label>
                                    <div class="col-sm-3">
                                        <h5 class="mt-1 no-resep-db"></h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama-pasien" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_pasien" class="col-sm-2 col-form-label">Status Pasien</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status-pasien" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_pasien" class="col-sm-2 col-form-label">No BPJS</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no-bpjs" placeholder="-" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jenis-kelamin" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="umur-pasien" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamat-pasien" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_dokter" class="col-sm-2 col-form-label">Nama Dokter</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama-dokter" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($obat_obatan as $obat) : ?>
                                        <tr class="obat-item">
                                            <td class="obat-kode"><?= $obat['kode_obat'] ?></td>
                                            <td class="obat-nama"><?= $obat['nama_obat'] ?></td>
                                            <td class="obat-satuan"><?= $obat['satuan'] ?></td>
                                            <td class="obat-stok"><?= $obat['stok'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-success btn-add-obat">&#65291;</button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Obat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover tbl-resep">
                                <thead>
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Qty</th>
                                        <th>Dosis Aturan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <div style="border-bottom: 1px dashed #aaa; font-size: 20px;" class="d-flex py-2">
                                <span>Total Obat :</span>
                                <span style="font-size: 20px;" class="cart-total-qty ml-auto">0</span>
                            </div>
                        </div>

                        <div class="card-footer justify-content-between">
                            <button type="button" class="btn bg-olive btn-simpan-resep"><i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary btn-reset-cart"><i class="fas fa-redo"></i> Reset</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
</form>
<!-- /.content -->

<?= $this->include('templates/script') ?>
<script>
    $('.show-pasien').hide();
    $('#no-resep').change(function() {
        <?php if (isset($resep_pasien)) : ?>
            var select_kode = $('select[name=no_resep] option').filter(':selected').val();
            $('.show-pasien').show();

            <?php
            $result = [];
            foreach ($resep_pasien as $pasien) {
                array_push($result, $pasien);
            }
            $js_rekamedis = json_encode($result);
            ?>

            let rekamedis = <?= $js_rekamedis ?>;
            rekamedis.forEach(function(row) {
                if (select_kode == row.no_resep) {
                    $('.no-resep-db').text("RP" + row.no_resep);
                    $('#nama-pasien').val(row.nama_pasien);
                    $('#status-pasien').val(row.status_pasien);
                    $('#no-bpjs').val(row.no_bpjs);
                    $('#jenis-kelamin').val(row.jenis_kelamin);
                    $('#umur-pasien').val(row.umur);
                    $('#alamat-pasien').val(row.alamat);
                    $('#nama-dokter').val(row.nama_dokter);
                }
                if (select_kode == '') {
                    $('.show-pasien').hide();
                }
            });

        <?php endif ?>
    });
</script>
<script>
    if (document.readyState == 'loading') {
        document.addEventListener('DOMContentLoaded', ready);
    } else {
        ready();
    }

    function ready() {
        var removeCartItemButtons = document.getElementsByClassName('remove-cart');
        console.log(removeCartItemButtons);
        for (var i = 0; i < removeCartItemButtons.length; i++) {
            var button = removeCartItemButtons[i];
            button.addEventListener('click', removeCartItem)
        }

        var qtyInputs = document.getElementsByClassName('cart-qty-input');
        for (var i = 0; i < qtyInputs.length; i++) {
            var input = qtyInputs[i];
            input.addEventListener('change', qtyChanged);
        }

        var addCartButtons = document.getElementsByClassName('btn-add-obat');
        for (var i = 0; i < addCartButtons.length; i++) {
            var button = addCartButtons[i];
            button.addEventListener('click', addToCartClicked);
        }

        document.getElementsByClassName('btn-simpan-resep')[0].addEventListener('click', simpanResepClick);
        document.getElementsByClassName('btn-reset-cart')[0].addEventListener('click', resetCartClick);
    }

    function resetCartClick(e) {
        var resetClick = e.target;
        var cartItems = resetClick.parentElement.parentElement;
        var cartList = cartItems.getElementsByClassName('cart-items')[0];
        document.getElementsByClassName('cart-total-qty')[0].innerText = 0;
        cartList.remove();
        $('.show-pasien').hide();
    }

    function simpanResepClick(e) {
        e.preventDefault();
        var kode_pasien = $('select[name=no_resep] option').filter(':selected').val();
        var qtyTotal = document.getElementsByClassName('cart-total-qty ')[0].innerText;

        if (kode_pasien != '') {
            var url = "<?= site_url('resep-obat/create'); ?>";
            var form = $('#formResep').serialize();
            console.log(form);
            $.ajax({
                type: "POST",
                url: url,
                data: form,
                success: function(res) {
                    switch (res) {
                        case 'success':
                            Swal.fire({
                                title: 'Transaksi berhasil',
                                text: "Apakah kamu ingin mencetak salinan resep ?",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Cetak',
                                cancelButtonText: 'Tidak',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var maxid = $("#maxId").val();
                                    var newid = Number(maxid) + 1;
                                    var link = "<?= base_url('cetak-resep') ?>/" + newid;
                                    location.href = link;
                                } else {
                                    location.href = "<?= base_url('resep-obat') ?>"
                                }
                            })
                            break;
                        case 'empty_obat':
                            Swal.fire(
                                'Tidak Bisa!',
                                'Pilih obat terlebih dahulu!',
                                'error'
                            )
                            break;
                        case 'empty_dosis':
                            Swal.fire(
                                'Tidak Bisa!',
                                'Pilih dosis terlebih dahulu!',
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
            if (kode_pasien == '') {
                Swal.fire(
                    'Tidak Bisa!',
                    'Pilih data pasien terlebih dahulu!',
                    'error'
                )
            }
        }
    }

    function removeCartItem(e) {
        var buttonClick = e.target;
        buttonClick.parentElement.parentElement.remove();
        updateCartTotal();
    }

    function qtyChanged(e) {
        var input = e.target;
        if (isNaN(input.value) || input.value <= 0) {
            input.parentElement.parentElement.remove();
        }
        updateCartTotal();
    }

    function addToCartClicked(e) {
        var addTabel = document.createElement('tbody');
        addTabel.classList.add('cart-items');
        var tabel = document.getElementsByClassName('tbl-resep')[0];
        tabel.append(addTabel);

        var button = e.target;
        var obatItem = button.parentElement.parentElement;
        var kode = obatItem.getElementsByClassName('obat-kode')[0].innerText;
        var stok = obatItem.getElementsByClassName('obat-stok')[0].innerText;
        var obat = obatItem.getElementsByClassName('obat-nama')[0].innerText;
        var satuan = obatItem.getElementsByClassName('obat-satuan')[0].innerText;
        console.log(kode, stok, obat, satuan);
        if (stok <= 0) {
            Swal.fire(
                'Tidak Bisa!',
                'Stok Obat Tidak Cukup!',
                'error'
            )
        } else {
            addItemToCart(kode, stok, obat, satuan);
            updateCartTotal();
        }
    }

    function addItemToCart(kode, stok, obat, satuan) {
        var cartRow = document.createElement('tr');
        cartRow.classList.add('cart-row');
        var cartItems = document.getElementsByClassName('cart-items')[0];
        var cartItemNames = cartItems.getElementsByClassName('cart-nama-obat');
        var totalQty = 0;
        for (var i = 0; i < cartItemNames.length; i++) {
            console.log(cartItemNames[i].innerText);
            if (cartItemNames[i].innerText == obat) {
                var qtyRow = cartItemNames[i];
                var cartRow = qtyRow.parentElement;
                var qtyElement = cartRow.getElementsByClassName('cart-qty-input')[0];
                var qty = parseInt(qtyElement.value);
                totalQty = qty + 1;
                cartRow.getElementsByClassName('cart-qty-input')[0].value = totalQty;
                return
            }
        }
        var cartRowContents =
            `<input type="hidden" name="kode_obat[]" class="kode_obat" value="${kode}">
            <input type="hidden" name="nama_obat[]" class="nama_obat" value="${obat}">
            <input type="hidden" name="satuan[]" class="satuan" value="${satuan}">
            <td class="cart-nama-obat">${obat}</td>
                <td>${satuan}</td>
                <td>
                    <input type="number" name="jumlah[]" class="form-control cart-qty-input" style="width:80px" value="1">
                </td>
                <td>
                    <select class="form-control dosisObat" name="dosis_aturan[]" style="width: 100%;">
                        <option value="" selected="selected">-- Pilih Dosis --</option>
                        <?php foreach ($aturan_obat as $aturan) : ?>
                            <option value="<?= $aturan['dosis_aturan_obat'] ?>"><?= $aturan['dosis_aturan_obat'] ?> - <?= $aturan['khusus'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-cart">&#x1D5EB;</button>
                </td>`
        cartRow.innerHTML = cartRowContents;
        cartItems.append(cartRow);
        cartRow.getElementsByClassName('remove-cart')[0].addEventListener('click', removeCartItem);
        cartRow.getElementsByClassName('cart-qty-input')[0].addEventListener('change', qtyChanged);
    }

    function updateCartTotal() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        var cartRows = cartItemContainer.getElementsByClassName('cart-row');
        var totalQty = 0;
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i];
            var qtyElement = cartRow.getElementsByClassName('cart-qty-input')[0];
            var qty = parseInt(qtyElement.value);
            totalQty = totalQty + qty;
        }
        document.getElementsByClassName('cart-total-qty')[0].innerText = totalQty;
    }
</script>
<?= $this->endSection('content') ?>