<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<?php
if (session()->get('id_user') == 2) {
  $judul = $title;
  $modalTitle = "Detail Pengambil Barang";
} else {
  $judul = "Riwayat Barang Keluar";
  $modalTitle = "Detail Barang Keluar";
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
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nomor Nota</th>
                  <th>Nama Outlet</th>
                  <th>Alamat Outlet</th>
                  <th class="text-right">Total Penjualan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($penjualan_barang as $penjualan) : ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $penjualan['tanggal'] ?></td>
                    <td><?= $penjualan['no_nota'] ?></td>
                    <td><?= $penjualan['outlet_name'] ?></td>
                    <td><?= $penjualan['outlet_alamat'] ?></td>
                    <td class="text-right"><?= "Rp " . number_format($penjualan['total'], 0, ',', '.') ?></td>
                    <td class="text-center">
                      <span data-toggle="tooltip" data-placement="top" title="Detail">
                        <a class="btn btn-sm btn-warning btn-view-penjualan" data-toggle="modal" data-target="#detail-<?= $penjualan['id_transaksi'] ?>"><i class="fas fa-eye"></i></a>
                      </span>
                      <span data-toggle="tooltip" data-placement="top" title="Cetak">
                        <a href="<?= base_url('cetak-nota') . "/" . $penjualan['id_transaksi'] ?>" target="_blank" class="btn btn-sm btn-primary btn-view-penjualan"><i class="fas fa-print"></i></a>
                      </span>
                    </td>
                  </tr>

                  <!-- Modal View  -->
                  <div class="modal fade" id="detail-<?= $penjualan['id_transaksi'] ?>">
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
                            <label class="col-sm-3 col-form-label">Nomor Nota</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $penjualan['no_nota'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $penjualan['tanggal'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Nama Outlet</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $penjualan['outlet_name'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Alamat Outlet</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $penjualan['outlet_alamat'] ?></h6>
                            </div>
                          </div>

                          <div class="container p-2">
                            <div class="row">
                              <div class="col-sm-1 detail-th">No</div>
                              <div class="col-sm-2 detail-th">Kode Barang</div>
                              <div class="col-sm-2 detail-th">Nama Barang</div>
                              <div class="col-sm-2 detail-th">Satuan</div>
                              <div class="col-sm-2 detail-th">Harga</div>
                              <div class="col-sm-1 detail-th">Jumlah</div>
                              <div class="col-sm-2 detail-th">Subtotal</div>
                            </div>
                            <?php
                            $j = 1;
                            $total = 0;
                            $totalHarga = 0;
                            ?>
                            <?php foreach ($detailBarang as $detail) : ?>
                              <?php if ($detail['id_transaksi'] == $penjualan['id_transaksi']) : ?>
                                <div class="row">
                                  <div class="col-sm-1 detail-cell"><?= $j++ ?></div>
                                  <div class="col-sm-2 detail-cell"><?= $detail['kode_barang'] ?></div>
                                  <div class="col-sm-2 detail-cell"><?= $detail['nama_barang'] ?></div>
                                  <div class="col-sm-2 detail-cell"><?= $detail['satuan_barang_name'] ?></div>
                                  <div class="col-sm-2 detail-cell"><?= "Rp " . number_format($detail['harga_jual'], 0, ',', '.') ?></div>
                                  <div class="col-sm-1 detail-cell"><?= $detail['jumlah'] ?></div>
                                  <div class="col-sm-2 detail-cell"><?= "Rp " . number_format($detail['jumlah'] * $detail['harga_jual'], 0, ',', '.') ?></div>
                                </div>
                                <?php $total = $total + $detail['jumlah'] ?>
                                <?php $totalHarga = $totalHarga + ($detail['jumlah'] * $detail['harga_jual']) ?>
                              <?php endif ?>
                            <?php endforeach ?>
                            <div class="row">
                              <div class="col-sm-9 detail-cell"><b>Total</b></div>
                              <div class="col-sm-1 detail-cell"><b><?= $total ?></b></div>
                              <div class="col-sm-2 detail-cell"><b><?= "Rp " . number_format($totalHarga, 0, ',', '.') ?></b></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  <?php $i++ ?>
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