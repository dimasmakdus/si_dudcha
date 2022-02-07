<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<?php
if (session()->get('name') == "Administrator") {
  $judul = $title;
  $modalTitle = "Detail Pengambil Obat";
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
                  <th>Kode Pasien</th>
                  <th>Status Pasien</th>
                  <th>Nama Pasien</th>
                  <th>Dokter</th>
                  <th>Total Obat</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($resep_obat as $resep) : ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $resep['tanggal'] ?></td>
                    <td><?= "RP" . $resep['kode_resep'] ?></td>
                    <td><?= $resep['status_pasien'] ?></td>
                    <td><?= $resep['nama_pasien'] ?></td>
                    <td><?= $resep['nama_dokter'] ?></td>
                    <td class="text-right"><?= $resep['total'] ?></td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-warning btn-view-resep" data-toggle="modal" data-target="#detail-<?= $resep['id_transaksi'] ?>"><i class="fas fa-eye"></i> Detail</a>
                    </td>
                  </tr>

                  <!-- Modal View  -->
                  <div class="modal fade" id="detail-<?= $resep['id_transaksi'] ?>">
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
                            <label class="col-sm-3 col-form-label">Nomor Obat</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['id_transaksi'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['tanggal'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Status Pasien</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['status_pasien'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Pasien/Pro</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['nama_pasien'] ?></h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['umur'] ?> Tahun</h6>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['alamat'] ?></h6>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Dokter</label>
                            <div class="col-xs-1 mt-1">:</div>
                            <div class="col-sm-8">
                              <h6 class="mt-2"><?= $resep['nama_dokter'] ?></h6>
                            </div>
                          </div>

                          <div class="container">
                            <div class="row">
                              <div class="col-sm-1 detail-th">No</div>
                              <div class="col-sm-1 detail-th">Kode Obat</div>
                              <div class="col-sm-4 detail-th">Nama Obat</div>
                              <div class="col-sm-3 detail-th">Dosis Aturan Obat</div>
                              <div class="col-sm-2 detail-th">Satuan</div>
                              <div class="col-sm-1 detail-th">Jumlah</div>
                            </div>
                            <?php
                            $j = 1;
                            $total = 0;
                            ?>
                            <?php foreach ($detailObat as $detail) : ?>
                              <?php if ($detail['id_transaksi'] == $resep['id_transaksi']) : ?>
                                <div class="row">
                                  <div class="col-sm-1 detail-cell"><?= $j++ ?></div>
                                  <div class="col-sm-1 detail-cell"><?= $detail['kode_obat'] ?></div>
                                  <div class="col-sm-4 detail-cell"><?= $detail['nama_obat'] ?></div>
                                  <div class="col-sm-3 detail-cell"><?= $detail['dosis_aturan_obat'] ?></div>
                                  <div class="col-sm-2 detail-cell"><?= $detail['satuan'] ?></div>
                                  <div class="col-sm-1 detail-cell"><?= $detail['jumlah'] ?></div>
                                </div>
                                <?php $total = $total + $detail['jumlah'] ?>
                              <?php endif ?>
                            <?php endforeach ?>
                            <div class="row">
                              <div class="col-sm-11 detail-cell">Total</div>
                              <div class="col-sm-1 detail-cell"><?= $total ?></div>
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