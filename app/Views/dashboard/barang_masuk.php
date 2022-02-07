<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<?php
if (session()->get('name') == "Administrator") {
    $judul = $title;
    $modalTitle = "Detail Pengajuan";
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
                        <?php if (session()->get('name') == "Administrator") : ?>
                            <a href="<?= base_url('barang-masuk-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah</a>
                        <?php endif ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Obat</th>
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
                                            echo $data['nama_supplier']
                                            ?>
                                        </td>
                                        <td><?= $beli['total'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#detail-<?= $beli['id'] ?>"><i class="fas fa-eye"></i> Detail</a>
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
                                                                echo $data['nama_supplier']
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-1 detail-th">No</div>
                                                            <div class="col-sm-2 detail-th">Kode Obat</div>
                                                            <div class="col-sm-3 detail-th">Nama Obat</div>
                                                            <div class="col-sm-2 detail-th">Satuan</div>
                                                            <div class="col-sm-2 detail-th">Tgl. Kadaluarsa</div>
                                                            <div class="col-sm-2 detail-th">Stok Yang Masuk</div>
                                                        </div>
                                                        <?php
                                                        $j = 1;
                                                        $total = 0;
                                                        ?>
                                                        <?php foreach ($detailObat as $detail) : ?>
                                                            <?php if ($detail['id_pembelian'] == $beli['id']) : ?>
                                                                <?php $obat = $obatModel->find($detail['kode_obat']); ?>
                                                                <div class="row">
                                                                    <div class="col-sm-1 detail-cell"><?= $j++ ?></div>
                                                                    <div class="col-sm-2 detail-cell"><?= $detail['kode_obat'] ?></div>
                                                                    <div class="col-sm-3 detail-cell"><?= $obat['nama_obat'] ?></div>
                                                                    <div class="col-sm-2 detail-cell"><?= $obat['satuan'] ?></div>
                                                                    <div class="col-sm-2 detail-cell"><?= $detail['tgl_kadaluarsa'] ?></div>
                                                                    <div class="col-sm-2 detail-cell"><?= $detail['stok_masuk'] ?></div>
                                                                </div>
                                                                <?php $total = $total + $detail['stok_masuk'] ?>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        <div class="row">
                                                            <div class="col-sm-10 detail-cell">Total</div>
                                                            <div class="col-sm-2 detail-cell"><?= $total ?></div>
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