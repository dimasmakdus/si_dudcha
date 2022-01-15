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
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Kode Resep</th>
                  <th>Status Pasien</th>
                  <th>Nama Pasien</th>
                  <th>Umur</th>
                  <th>Alamat</th>
                  <th>Dokter</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($resep_obat as $resep) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $resep['tanggal'] ?></td>
                    <td><?= $resep['kode_resep'] ?></td>
                    <td><?= $resep['status_pasien'] ?></td>
                    <td><?= $resep['nama_pasien'] ?></td>
                    <td><?= $resep['umur'] ?></td>
                    <td><?= $resep['alamat'] ?></td>
                    <td><?= $resep['nama_dokter'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-warning btn-view-resep" data-toggle="modal" data-target="#detail-<?= $resep['id_transaksi'] ?>"><i class="fas fa-eye"></i> Detail</a>
                      <a target="_blank" href="<?= base_url('cetak-resep') ?>/<?= $resep['id_transaksi'] ?>" class="btn btn-sm bg-info btn-print-resep"><i class="fas fa-print"></i> Cetak</a>
                    </td>
                  </tr>

                  <!-- Modal View  -->
                  <div class="modal fade" id="detail-<?= $resep['id_transaksi'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Detail Obat</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <div class="row">
                              <div class="col-sm-1" style="display:table-cell;border:1px solid #CCC;">No</div>
                              <div class="col-sm-2" style="display:table-cell;border:1px solid #CCC;">Kode Obat</div>
                              <div class="col-sm-5" style="display:table-cell;border:1px solid #CCC;">Nama Obat</div>
                              <div class="col-sm-2" style="display:table-cell;border:1px solid #CCC;">Satuan</div>
                              <div class="col-sm-2" style="display:table-cell;border:1px solid #CCC;">jumlah</div>
                            </div>
                            <?php $j = 1; ?>
                            <?php foreach ($detailObat as $detail) : ?>
                              <?php if ($detail['id_transaksi'] == $resep['id_transaksi']) : ?>
                                <div class="row">
                                  <div class="col-sm-1" style="display:table-cell;border:1px solid #CCC;"><?= $j++ ?></div>
                                  <div class="col-sm-2" style="display:table-cell;border:1px solid #CCC;"><?= $detail['kode_obat'] ?></div>
                                  <div class="col-sm-5" style="display:table-cell;border:1px solid #CCC;"><?= $detail['nama_obat'] ?></div>
                                  <div class="col-sm-2" style="display:table-cell;border:1px solid #CCC;"><?= $detail['satuan'] ?></div>
                                  <div class="col-sm-2" style="display:table-cell;border:1px solid #CCC;"><?= $detail['jumlah'] ?></div>
                                </div>
                              <?php endif ?>
                            <?php endforeach ?>
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