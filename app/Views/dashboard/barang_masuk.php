<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<?php
if (session()->get('id_user') == 1) {
    $judul = $title;
    $modalTitle = "Detail Barang Masuk";
} else {
    $judul = "Riwayat Barang Masuk";
    $modalTitle = "Detail Barang Masuk";
}
?>
<style>
    .detail-cell {
        font-family: "Source Sans Pro", "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        display: table-cell;
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        vertical-align: top;
    }

    .detail-th {
        font-family: "Source Sans Pro", "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        display: table-cell;
        font-weight: bold;
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        vertical-align: top;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $judul ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $judul ?></li>
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
                        <h3 class="card-title"><?= $judul ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        if (session()->getFlashData('success')) {
                        ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i>
                                <?= session()->getFlashData('success') ?>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (session()->getFlashData('error')) {
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <?= session()->getFlashData('error') ?>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th class="text-right">Total Pembelian</th>
                                    <?= (session()->get('id_user') == 2 || session()->get('id_user') == 3) ? "<th class='text-center'>Status Pembayaran</th>" : null ?>
                                    <?= (session()->get('id_user') == 2 || session()->get('id_user') == 3) ? "<th>Tgl. Jatuh Tempo</th>" : null ?>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($pembelian as $beli) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $beli['faktur'] ?></td>
                                        <td><?= $beli['tanggal'] ?></td>
                                        <td>
                                            <?php
                                            $data = $supplier->find($beli['kode_supplier']);
                                            echo $data != null ? $data['nama_supplier'] : null
                                            ?>
                                        </td>
                                        <td class="text-right"><?= "Rp " . number_format($beli['total'], 0, ',', '.') ?></td>

                                        <?php if (session()->get('id_user') == 2 || session()->get('id_user') == 3) : ?>
                                            <td class="text-center">
                                                <?php
                                                if ($beli['status_pembayaran'] == 'true') { ?>
                                                    <small class="badge badge-success"><i class="fas fa-check"></i> Lunas</small>
                                                <?php } else { ?>
                                                    <small class="badge badge-danger"><i class="fas fa-times"></i> Belum Lunas</small>
                                                <?php } ?>
                                            </td>
                                        <?php endif ?>

                                        <?php if (session()->get('id_user') == 2 || session()->get('id_user') == 3) : ?>
                                            <td>
                                                <?php
                                                if ($beli['status_pembayaran'] == 'false') {
                                                    echo isset($beli['tgl_jatuh_tempo']) ? $base->tanggal(date("Y-m-d", strtotime($beli['tgl_jatuh_tempo']))) : '';
                                                }
                                                ?>
                                            </td>
                                        <?php endif ?>

                                        <td class="text-center">
                                            <?php if (session()->get('id_user') == 2) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Ubah">
                                                    <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail-<?= $beli['id'] ?>"><i class="fas fa-edit"></i></a>
                                                </span>
                                            <?php } else { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#detail-<?= $beli['id'] ?>"><i class="fas fa-eye"></i></a>
                                                </span>
                                            <?php } ?>

                                            <!-- <?php if (session()->get('id_user') == 2) : ?>
                                                <?php if ($beli['status_pembayaran'] == 'true') : ?>
                                                    <span data-toggle="tooltip" data-placement="top" title="Cetak">
                                                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#print-<?= $beli['id'] ?>"><i class="fas fa-print"></i></a>
                                                    </span>
                                                <?php endif ?>
                                            <?php endif ?> -->
                                        </td>
                                    </tr>

                                    <!-- Modal View  -->
                                    <div class="modal fade" id="detail-<?= $beli['id'] ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= $modalTitle ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php if (session()->get('id_user') == 2) : ?>
                                                        <form id="form-update-pembayaran-<?= $beli['id'] ?>">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Status Pembayaran</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <select name="status_pembayaran" id="status_pembayaran-<?= $beli['id'] ?>" class="form-control" onchange="changeStatus(<?= $beli['id'] ?>)">
                                                                        <option value="" disabled selected>-- Pilih Status Pembayaran --</option>
                                                                        <?php foreach ($status_pembayaran as $key => $value) : ?>
                                                                            <option value="<?= $key ?>" <?= $key == $beli['status_pembayaran'] ? 'selected' : '' ?>><?= $value ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="hidden" name="id" value="<?= $beli['id'] ?>">
                                                                    <button type="button" class="btn btn-primary" onclick="updatePembayaran(<?= $beli['id'] ?>)"><i class="fas fa-save"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row jatuhTempo <?= $beli['status_pembayaran'] == 'true' ? 'd-none' : '' ?>">
                                                                <label for="tgl_jatuh_tempo" class="col-sm-3 col-form-label">Tgl. Jatuh Tempo</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <input type="date" class="form-control" value="<?= isset($beli['tgl_jatuh_tempo']) ? $beli['tgl_jatuh_tempo'] : '' ?>" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo">
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <hr />
                                                        <h4>Detail Barang</h4>
                                                    <?php endif ?>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Nomor Faktur</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2"><?= $beli['faktur'] ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Tanggal</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2"><?= $beli['tanggal'] ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label">Supplier</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2">
                                                                <?php
                                                                $data = $supplier->find($beli['kode_supplier']);
                                                                echo $data != null ? $data['nama_supplier'] : null
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <?php if (session()->get('id_user') == 2) : ?>
                                                        <div class="row mb-3">
                                                            <label class="col-sm-3 col-form-label">Status Pembayaran</label>
                                                            <div class="col-xs-1 mt-1">:</div>
                                                            <div class="col-sm-8">
                                                                <h6 class="mt-2">
                                                                    <?php
                                                                    if ($beli['status_pembayaran'] == 'true') { ?>
                                                                        <small class="badge badge-success"><i class="fas fa-check"></i> Lunas</small>
                                                                    <?php } else { ?>
                                                                        <small class="badge badge-danger"><i class="fas fa-times"></i> Belum Lunas</small>
                                                                    <?php } ?>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-1 detail-th">No</div>
                                                            <div class="col-md-3 detail-th">Nama Barang</div>
                                                            <div class="col-md-1 detail-th">Harga Beli</div>
                                                            <div class="col-md-1 detail-th">Satuan Beli</div>
                                                            <div class="col-md-1 detail-th">Jumlah Beli</div>
                                                            <div class="col-md-1 detail-th">Isi Dalam Kemasan</div>
                                                            <div class="col-md-2 detail-th">Stok Yang Masuk</div>
                                                            <div class="col-md-2 detail-th text-right">Subtotal</div>
                                                        </div>
                                                        <?php
                                                        $j = 1;
                                                        $total = 0;
                                                        $totalHarga = 0;
                                                        ?>
                                                        <?php foreach ($detailBarang as $detail) : ?>
                                                            <?php if ($detail['id_pembelian'] == $beli['id']) : ?>
                                                                <?php
                                                                $barang = $barangModel
                                                                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                                                                    ->find($detail['kode_barang']);
                                                                ?>
                                                                <?php if (isset($barang)) : ?>
                                                                    <div class="row">
                                                                        <div class="col-md-1 detail-cell"><?= $j++ ?></div>
                                                                        <div class="col-md-3 detail-cell"><?= $barang['nama_barang'] ?></div>
                                                                        <div class="col-md-1 detail-cell text-right"><?= "Rp " . number_format($detail['harga_beli'], 0, ',', '.') ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $detail['satuan_barang_name'] ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $detail['stok_beli'] ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $barang['nilai_satuan'] . " " . $barang['satuan_barang_name'] ?></div>
                                                                        <div class="col-md-2 detail-cell"><?= $detail['stok_masuk'] . " " . $barang['satuan_barang_name'] ?></div>
                                                                        <div class="col-md-2 detail-cell text-right"><?= "Rp " . number_format($detail['harga_beli'] * $detail['stok_beli'], 0, ',', '.') ?></div>
                                                                    </div>
                                                                    <?php $total = $total + $detail['stok_masuk'] ?>
                                                                    <?php $totalHarga = $totalHarga + ($detail['harga_beli'] * $detail['stok_beli']) ?>
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        <div class="row">
                                                            <div class="col-md-8 detail-cell"><b>Total</b></div>
                                                            <div class="col-md-2 detail-cell"><b><?= $total ?></b></div>
                                                            <div class="col-md-2 detail-cell text-right"><b><?= "Rp " . number_format($totalHarga, 0, ',', '.')  ?></b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Print  -->
                                    <!-- <div class="modal fade" id="print-<?= $beli['id'] ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Cetak Kuitansi Pembayaran</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php if (session()->get('id_user') == 2) : ?>
                                                        <form id="cetak-kuitansi">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Telah Diterima dari</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="diterima" class="form-control">
                                                                    <input type="hidden" name="id_pembeli" value="<?= $beli['id'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Untuk Pembayaran</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="pembayaran" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Pihak 1</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <?php $pihak1 = session()->get('name') ?>
                                                                    <input type="text" name="bagian_keuangan" class="form-control" value="<?= $pihak1 ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Pihak 2 (Supplier)</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <?php
                                                                    $data = $supplier->find($beli['kode_supplier']);
                                                                    $pihak2 = $data != null ? $data['nama_supplier'] : null
                                                                    ?>
                                                                    <input type="text" name="supplier" value="<?= $pihak2 ?>" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Harga yang harus dibayar (total)</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <h5 class="mt-1"><?= "Rp " . number_format($beli['total'], 0, ',', '.') ?></h5>
                                                                    <input type="hidden" name="harga_total" id="totalHarga-<?= $beli['id'] ?>" value="<?= $beli['total'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Jumlah Uang</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" id="uang_rupiah" onkeyup="keyUpHarga(<?= $beli['id'] ?>)" class="form-control">
                                                                        <input type="hidden" name="jumlah_uang" id="jumlah_uang" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Kembalian</label>
                                                                <div class="col-xs-1 mt-1">:</div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" name="uang_kembalian" id="uang_kembalian" class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <button type="button" class="btn btn-primary" onclick="cetakKuitansi()"><i class="fas fa-print"></i> Cetak</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <hr />
                                                        <h4>Detail Barang</h4>
                                                    <?php endif ?>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Nomor Faktur</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2"><?= $beli['faktur'] ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Tanggal</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2"><?= $beli['tanggal'] ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Supplier</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2">
                                                                <?php
                                                                $data = $supplier->find($beli['kode_supplier']);
                                                                echo $data != null ? $data['nama_supplier'] : null
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <?php if (session()->get('id_user') == 2) : ?>
                                                        <div class="row mb-3">
                                                            <label class="col-sm-3 col-form-label">Status Pembayaran</label>
                                                            <div class="col-xs-1 mt-1">:</div>
                                                            <div class="col-sm-8">
                                                                <h6 class="mt-2">
                                                                    <?php
                                                                    if ($beli['status_pembayaran'] == 'true') { ?>
                                                                        <small class="badge badge-success"><i class="fas fa-check"></i> Lunas</small>
                                                                    <?php } else { ?>
                                                                        <small class="badge badge-danger"><i class="fas fa-times"></i> Belum Lunas</small>
                                                                    <?php } ?>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-1 detail-th">No</div>
                                                            <div class="col-md-3 detail-th">Nama Barang</div>
                                                            <div class="col-md-1 detail-th">Harga Beli</div>
                                                            <div class="col-md-1 detail-th">Satuan Beli</div>
                                                            <div class="col-md-1 detail-th">Jumlah Beli</div>
                                                            <div class="col-md-1 detail-th">Satuan di Gudang</div>
                                                            <div class="col-md-1 detail-th">Isi Dalam Kemasan</div>
                                                            <div class="col-md-1 detail-th">Stok Yang Masuk</div>
                                                            <div class="col-md-2 detail-th text-right">Subtotal</div>
                                                        </div>
                                                        <?php
                                                        $j = 1;
                                                        $total = 0;
                                                        $totalHarga = 0;
                                                        ?>
                                                        <?php foreach ($detailBarang as $detail) : ?>
                                                            <?php if ($detail['id_pembelian'] == $beli['id']) : ?>
                                                                <?php
                                                                $barang = $barangModel
                                                                    ->join('tbl_satuan_barang', 'tbl_satuan_barang.satuan_barang_id = tbl_barang.satuan', 'left')
                                                                    ->find($detail['kode_barang']);
                                                                ?>
                                                                <?php if (isset($barang)) : ?>
                                                                    <div class="row">
                                                                        <div class="col-md-1 detail-cell"><?= $j++ ?></div>
                                                                        <div class="col-md-3 detail-cell"><?= $barang['nama_barang'] ?></div>
                                                                        <div class="col-md-1 detail-cell text-right"><?= "Rp " . number_format($detail['harga_beli'], 0, ',', '.') ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $detail['satuan_barang_name'] ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $detail['stok_beli'] ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $barang['satuan_barang_name'] ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $barang['nilai_satuan'] ?></div>
                                                                        <div class="col-md-1 detail-cell"><?= $detail['stok_masuk'] ?></div>
                                                                        <div class="col-md-2 detail-cell text-right"><?= "Rp " . number_format($detail['harga_beli'] * $detail['stok_beli'], 0, ',', '.') ?></div>
                                                                    </div>
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                            <?php $total = $total + $detail['stok_masuk'] ?>
                                                            <?php $totalHarga = $totalHarga + ($detail['harga_beli'] * $detail['stok_beli']) ?>
                                                        <?php endforeach ?>
                                                        <div class="row">
                                                            <div class="col-md-9 detail-cell"><b>Total</b></div>
                                                            <div class="col-md-1 detail-cell"><b><?= $total ?></b></div>
                                                            <div class="col-md-2 detail-cell text-right"><b><?= "Rp " . number_format($totalHarga, 0, ',', '.')  ?></b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                    <!-- /.modal-content -->

                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
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
<!-- /.content -->

<?= $this->include('templates/script') ?>

<script>
    function changeStatus(id) {
        var value = $('select[id=status_pembayaran-' + id + '] option').filter(':selected').val();
        if (value == 'true') {
            $('.jatuhTempo').addClass('d-none');
        } else {
            $('.jatuhTempo').removeClass('d-none')
        }
    }

    function keyUpHarga(id) {
        var hargaElement = document.getElementById('uang_rupiah');
        var hargaValue = hargaElement.value
        hargaElement.value = currencyChange(hargaValue.toString())
        hargaCurrency = parseInt(currencyChange(hargaValue.toString()).replace(/[^,\d]/g, '').toString())

        var totalHargaElement = document.getElementById('totalHarga-' + id).value
        var totalHarga = parseInt(totalHargaElement.replace(/[^,\d]/g, '').toString())

        var kembalianElement = document.getElementById('uang_kembalian')

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
</script>

<script>
    $(document).ready(function() {
        $("input#uang_rupiah").keyup(function(e) {
            e.preventDefault();
            var value = e.target.value

            $('#jumlah_uang').val(value.replaceAll(".", ""))
            $('#uang_rupiah').val(currencyChange(value.toString()))
        });
    });

    function updatePembayaran(id) {
        var url = "<?= base_url('barang-masuk/updatePembayaran'); ?>/" + id;
        var form = $('#form-update-pembayaran-' + id).serialize();

        $.ajax({
            type: "GET",
            url: url,
            data: form,
            success: function(res) {
                switch (res) {
                    case 'success':
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan!',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "<?= base_url('barang-masuk') ?>";
                            }
                        })
                        break;
                    case 'error':
                        Swal.fire(
                            'Gagal!',
                            'Data gagal disimpan!',
                            'error'
                        )
                        break;
                    case 'tgl_kosong':
                        Swal.fire(
                            'Gagal!',
                            'Tanggal Jatuh Tempo tidak boleh kosong!',
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
    function cetakKuitansi() {
        var url = "<?= base_url('cetak-kuitansi'); ?>";
        var form = $('#cetak-kuitansi').serialize();

        $.ajax({
            type: "GET",
            url: url,
            data: form,
            success: function(res) {
                window.open(url + "?" + form, "_blank")
            },
        });
    }
</script>

<?= $this->endSection('content') ?>