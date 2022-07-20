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
                                <label for="no-resep" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= date("d/m/Y") ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no-resep" class="col-sm-2 col-form-label">Pilih Tujuan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="outlet_id" id="outlet_id" style="width: 100%;">
                                        <option value="" selected>-- Pilih Outlet--</option>
                                        <?php foreach ($data_outlet as $outlet) : ?>
                                            <option value="<?= $outlet['outlet_id'] ?>"><?= $outlet['outlet_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="show-outlet-detail card p-4">
                                <div class="form-group row">
                                    <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Outlet</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama-outlet" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_pasien" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamat-outlet" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_pasien" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status-outlet" disabled>
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
                <div class="col-sm-6">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="penjualan-barang" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($barang_barangan as $barang) : ?>
                                        <tr class="barang-item">
                                            <td class="barang-kode"><?= $barang['kode_barang'] ?></td>
                                            <td class="barang-nama"><?= $barang['nama_barang'] ?></td>
                                            <td class="text-right"><?= "Rp " . number_format($barang['harga_jual'], 0, ',', '.') ?></td>
                                            <td class="barang-harga text-right d-none"><?= $barang['harga_jual'] ?></td>
                                            <td class="barang-satuan-code" style="display:none;"><?= $barang['satuan'] ?></td>
                                            <td class="barang-satuan-name"><?= $barang['satuan_barang_name'] ?></td>
                                            <td class="barang-stok text-center"><?= $barang['stok'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm bg-olive btn-add-barang">&#65291;</button>
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


                <div class="col-sm-6">
                    <div class="card card-barang">
                        <div class="card-header">
                            <h3 class="card-title">Barang</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover tbl-resep">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Qty</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pembayaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div style="border-bottom: 1px dashed #aaa; font-size: 20px;" class="d-flex py-2">
                                <span>Total :</span>
                                <span style="font-size: 20px;" class="cart-total-qty ml-auto">Rp 0</span>
                            </div>
                        </div>

                        <div class="card-footer justify-content-between">
                            <input type="hidden" class="form-control" value="<?= session()->get('name') ?>" name="sales">
                            <button type="button" class="btn bg-olive" onclick="showModalVerify()"><i class="fas fa-dolly-flatbed"></i> Jual</button>
                            <button type="button" class="btn btn-secondary btn-reset-cart"><i class="fas fa-redo"></i> Reset</button>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="no-resep" class="col-sm-3 col-form-label">Bayar (Rp)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="keyupHarga" onkeyup="keyUpHarga()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no-resep" class="col-sm-3 col-form-label">Kembalian</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="keyupKembali" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-simpan-resep">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>

</form>
<!-- /.content -->

<?= $this->include('templates/script') ?>
<script>
    var validKembalian = false

    function keyUpHarga() {
        var hargaElement = document.getElementById('keyupHarga');
        var hargaValue = hargaElement.value
        hargaElement.value = currencyChange(hargaValue.toString())
        hargaCurrency = parseInt(currencyChange(hargaValue.toString()).replace(/[^,\d]/g, '').toString())

        var totalHargaElement = document.getElementsByClassName('cart-total-qty')[0].innerText
        var totalHarga = parseInt(totalHargaElement.replace(/[^,\d]/g, '').toString())

        var kembalianElement = document.getElementById('keyupKembali')

        if (hargaCurrency > totalHarga) {
            var kembalian = hargaCurrency - totalHarga
            kembalianElement.value = currencyChange(kembalian.toString())
            validKembalian = true
        } else if (hargaCurrency == totalHarga) {
            kembalianElement.value = "Uang Pas"
            validKembalian = true
        } else {
            kembalianElement.value = "Belum Cukup"
            validKembalian = false
        }
    }

    function showModalVerify() {
        var optionOutlet = $('select[name=outlet_id] option').filter(':selected').val();
        var qtyTotal = document.getElementsByClassName('cart-total-qty ')[0].innerText;

        if (optionOutlet != '') {
            if (qtyTotal != "Rp 0") {
                $('#modal-transaksi').modal('show')
            } else {
                Swal.fire(
                    'Tidak Bisa!',
                    'Pilih Barang terlebih dahulu!',
                    'error'
                )
            }
        } else {
            Swal.fire(
                'Tidak Bisa!',
                'Pilih Outlet terlebih dahulu!',
                'error'
            )
        }
    }
</script>
<script>
    $('.show-outlet-detail').hide();
    $('#outlet_id').change(function() {
        <?php if (isset($data_outlet)) : ?>
            var select_kode = $('select[name=outlet_id] option').filter(':selected').val();
            $('.show-outlet-detail').show();

            <?php
            $result = [];
            foreach ($data_outlet as $outlet) {
                array_push($result, $outlet);
            }
            $json_outlet = json_encode($result);
            ?>

            let outlet = <?= $json_outlet ?>;
            console.log(outlet)
            outlet.forEach(function(row) {
                if (select_kode == row.outlet_id) {
                    $('#nama-outlet').val(row.outlet_name);
                    $('#alamat-outlet').val(row.outlet_alamat);
                    $('#status-outlet').val(row.outlet_status == 1 ? 'Aktif' : 'Tidak Aktif');
                }
                if (select_kode == '') {
                    $('.show-outlet-detail').hide();
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

        var addCartButtons = document.getElementsByClassName('btn-add-barang');
        for (var i = 0; i < addCartButtons.length; i++) {
            var button = addCartButtons[i];
            button.addEventListener('click', addToCartClicked);
        }

        document.getElementsByClassName('btn-simpan-resep')[0].addEventListener('click', simpanBarangClick);
        document.getElementsByClassName('btn-reset-cart')[0].addEventListener('click', resetCartClick);
    }

    function resetCartClick(e) {
        var resetClick = e.target;
        var cartItems = resetClick.parentElement.parentElement.parentElement;
        var cartList = cartItems.getElementsByClassName('cart-items')[0];
        document.getElementsByClassName('cart-total-qty')[0].innerText = "Rp 0";

        cartList != undefined ? cartList.remove() : ''

        $('#outlet_id').prop('selectedIndex', 0)
        $('.show-outlet-detail').hide();
    }

    function simpanBarangClick(e) {
        e.preventDefault();
        var optionOutlet = $('select[name=outlet_id] option').filter(':selected').val();
        var qtyTotal = document.getElementsByClassName('cart-total-qty ')[0].innerText;

        if (optionOutlet != '') {
            if (validKembalian) {
                var url = "<?= site_url('penjualan-barang/create'); ?>";
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
                                    text: "Apakah kamu ingin mencetak nota penjualan ?",
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
                                        var link = "<?= base_url('cetak-nota') ?>/" + newid;
                                        location.href = link;
                                    } else {
                                        location.href = "<?= base_url('riwayat-penjualan-barang') ?>"
                                    }
                                })
                                break;
                            case 'empty_barang':
                                Swal.fire(
                                    'Tidak Bisa!',
                                    'Pilih Barang terlebih dahulu!',
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
                Swal.fire(
                    'Tidak Bisa!',
                    'Masukkan pembayaran terlebih dahulu!',
                    'error'
                )
            }
        } else {
            if (optionOutlet == '') {
                Swal.fire(
                    'Tidak Bisa!',
                    'Pilih Outlet terlebih dahulu!',
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

        var stokBarang = input.parentElement.parentElement;
        var stok = stokBarang.getElementsByClassName('toStok')[0].value
        console.log(stok)
        console.log(input.value)

        if (parseInt(input.value) > parseInt(stok)) {
            Swal.fire(
                'Tidak Bisa!',
                'Stok Barang Tidak Cukup!',
                'error'
            )
            var qty = input.parentElement;
            qty.getElementsByClassName('cart-qty-input')[0].value = stok
            return
        } else {
            updateCartTotal();
        }
    }

    function addToCartClicked(e) {
        var addTabel = document.createElement('tbody');
        addTabel.classList.add('cart-items');
        var tabel = document.getElementsByClassName('tbl-resep')[0];
        tabel.append(addTabel);

        var button = e.target;
        var barangItem = button.parentElement.parentElement;
        var kode = barangItem.getElementsByClassName('barang-kode')[0].innerText;
        var stok = barangItem.getElementsByClassName('barang-stok')[0].innerText;
        var barang = barangItem.getElementsByClassName('barang-nama')[0].innerText;
        var harga = barangItem.getElementsByClassName('barang-harga')[0].innerText;
        var satuan_code = barangItem.getElementsByClassName('barang-satuan-code')[0].innerText;
        var satuan_name = barangItem.getElementsByClassName('barang-satuan-name')[0].innerText;
        console.log(kode, stok, harga, barang, satuan_code);
        if (stok <= 0) {
            Swal.fire(
                'Tidak Bisa!',
                'Stok Barang Tidak Cukup!',
                'error'
            )
        } else {
            addItemToCart(kode, stok, harga, barang, satuan_code, satuan_name);
            updateCartTotal();
        }
    }

    function addItemToCart(kode, stok, harga, barang, satuan_code, satuan_name) {
        var cartRow = document.createElement('tr');
        cartRow.classList.add('cart-row');
        var cartItems = document.getElementsByClassName('cart-items')[0];
        var cartItemNames = cartItems.getElementsByClassName('cart-nama-barang');
        var totalQty = 0;
        for (var i = 0; i < cartItemNames.length; i++) {
            console.log(cartItemNames[i].innerText);
            if (cartItemNames[i].innerText == barang) {
                var qtyRow = cartItemNames[i];
                var cartRow = qtyRow.parentElement;
                var qtyElement = cartRow.getElementsByClassName('cart-qty-input')[0];
                var qty = parseInt(qtyElement.value);
                if (qty != stok) {
                    totalQty = qty + 1;
                    cartRow.getElementsByClassName('cart-qty-input')[0].value = totalQty;
                    return
                } else {
                    Swal.fire(
                        'Tidak Bisa!',
                        'Stok Barang Tidak Cukup!',
                        'error'
                    )
                    totalQty = qty
                    cartRow.getElementsByClassName('cart-qty-input')[0].value = totalQty;
                    return
                }
            }
        }
        var cartRowContents =
            `<input type="hidden" name="kode_barang[]" class="kode_barang" value="${kode}">
            <input type="hidden" name="nama_barang[]" class="nama_barang" value="${barang}">
            <input type="hidden" name="satuan[]" class="satuan" value="${satuan_code}">
            <input type="hidden" name="harga_jual[]" class="harga_jual" value="${harga}">
            <input type="hidden" class="toStok" value="${stok}">
            <td class="cart-nama-barang">${barang}</td>
                <td>${"Rp " + currencyChange(harga.toString())}</td>
                <td>${satuan_name}</td>
                <td class="text-center">
                    <input type="number" name="jumlah[]" class="form-control cart-qty-input" style="width:80px" value="1">
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
            var hargaJualElement = cartRow.getElementsByClassName('harga_jual')[0];
            var hargaJual = parseInt(hargaJualElement.value)
            var qty = parseInt(qtyElement.value);
            totalQty = totalQty + (qty * hargaJual);
        }
        document.getElementsByClassName('cart-total-qty')[0].innerText = "Rp " + currencyChange(totalQty.toString());
    }
</script>
<?= $this->endSection('content') ?>