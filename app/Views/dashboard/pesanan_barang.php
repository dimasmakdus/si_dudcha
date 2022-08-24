<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
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
                        <a href="<?= base_url('pesanan-barang-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pemesanan</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Supplier Dituju</th>
                                    <th>Status Pemesanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($permintaan_barang as $permintaan) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $permintaan['kode_pesanan'] ?></td>
                                        <td><?= $permintaan['tanggal'] ?></td>
                                        <td>
                                            <?php foreach ($supplier as $supp) {
                                                if ($supp['kode_supplier'] == $permintaan['kode_supplier']) {
                                                    echo $supp['nama_supplier'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php switch ($permintaan['status']) {
                                                case 'waiting': ?>
                                                    <small class="badge badge-warning"><i class="far fa-clock"></i> Menunggu Persetujuan</small>
                                                    <?php break; ?>
                                                <?php
                                                case 'approved': ?>
                                                    <small class="badge badge-success"><i class="fas fa-check"></i> Disetujui</small>
                                                    <?php break; ?>
                                                <?php
                                                case 'cancel': ?>
                                                    <small class="badge badge-danger"><i class="fas fa-times"></i> Ditolak</small>
                                                    <?php break; ?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="top" title="Detail">
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#detail-<?= $permintaan['id'] ?>"><i class="fas fa-eye"></i></button>
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Modal View  -->
                                    <div class="modal fade" id="detail-<?= $permintaan['id'] ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Pengajuan</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Nomor Pemesanan</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2"><?= $permintaan['kode_pesanan'] ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Tanggal</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2"><?= $permintaan['tanggal'] ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Supplier Dituju</label>
                                                        <div class="col-xs-1 mt-1">:</div>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-2">
                                                                <?php foreach ($supplier as $supp) {
                                                                    if ($supp['kode_supplier'] == $permintaan['kode_supplier']) {
                                                                        echo $supp['nama_supplier'];
                                                                    }
                                                                }
                                                                ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label">Status</label>
                                                        <div class="col-xs-1">:</div>
                                                        <div class="col-sm-8">
                                                            <?php switch ($permintaan['status']) {
                                                                case 'waiting': ?>
                                                                    <small class="badge badge-warning"><i class="far fa-clock"></i> Menunggu Persetujuan</small>
                                                                    <?php break; ?>
                                                                <?php
                                                                case 'approved': ?>
                                                                    <small class="badge badge-success"><i class="fas fa-check"></i> Disetujui</small>
                                                                    <?php break; ?>
                                                                <?php
                                                                case 'cancel': ?>
                                                                    <small class="badge badge-danger"><i class="fas fa-times"></i> Ditolak</small>
                                                                    <?php break; ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-1 detail-th">No</div>
                                                            <div class="col-sm-3 detail-th">Nama Barang</div>
                                                            <div class="col-sm-2 detail-th">Harga</div>
                                                            <div class="col-sm-2 detail-th">Jumlah</div>
                                                            <div class="col-sm-4 detail-th">Subtotal</div>
                                                        </div>
                                                        <?php
                                                        $j = 1;
                                                        $total = 0;
                                                        $totalHarga = 0;
                                                        ?>
                                                        <?php foreach ($detailBarang as $detail) : ?>
                                                            <?php if ($detail['id_permintaan'] == $permintaan['id']) : ?>
                                                                <div class="row">
                                                                    <div class="col-sm-1 detail-cell"><?= $j++ ?></div>
                                                                    <div class="col-sm-3 detail-cell"><?= $detail['nama_barang'] ?></div>
                                                                    <div class="col-sm-2 detail-cell"><?= "Rp " . number_format($detail['harga_beli'], 0, ',', '.') ?></div>
                                                                    <div class="col-sm-2 detail-cell"><?= $detail['stok'] . " " . $detail['satuan_barang_name'] ?></div>
                                                                    <div class="col-sm-4 detail-cell"><?= "Rp " . number_format($detail['stok'] * $detail['harga_beli'], 0, ',', '.') ?></div>
                                                                </div>
                                                                <?php $total = $total + $detail['stok'] ?>
                                                                <?php $totalHarga = $totalHarga + ($detail['stok'] * $detail['harga_beli']) ?>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        <div class="row">
                                                            <div class="col-sm-8 detail-cell"><b>Total</b></div>
                                                            <!-- <div class="col-sm-2 detail-cell"><b><?= $total ?></b></div> -->
                                                            <div class="col-sm-4 detail-cell"><b><?= "Rp " . number_format($totalHarga, 0, ',', '.') ?></b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
<?= $this->endSection('content') ?>