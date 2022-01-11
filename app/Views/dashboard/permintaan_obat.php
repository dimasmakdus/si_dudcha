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
            <?php
            if (session()->getFlashData('success')) {
            ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i>
                <?= session()->getFlashData('success') ?>
              </div>
            <?php
            }
            ?>
            <a href="<?= base_url('permintaan-obat-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
            <a target="_blank" href="<?= base_url('cetak-lplpo') ?>" class="btn bg-primary mb-3"><i class="fas fa-print"></i> Cetak Laporan</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Jenis Obat</th>
                  <th>Stok Awal</th>
                  <th>Penerimaan</th>
                  <th>Persediaan</th>
                  <th>Pemakaian</th>
                  <th>Sisa Akhir</th>
                  <th>Stok Optimum</th>
                  <th>Permintaan</th>
                  <th>Pemberian</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($permintaan_obat as $lplpo) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $lplpo['kode_obat'] ?></td>
                    <td><?= $lplpo['nama_obat'] ?></td>
                    <td><?= $lplpo['jenis_obat'] ?></td>
                    <td><?= $lplpo['stok_awal'] ?></td>
                    <td><?= $lplpo['penerimaan'] ?></td>
                    <td><?= $lplpo['persediaan'] ?></td>
                    <td><?= $lplpo['pemakaian'] ?></td>
                    <td><?= $lplpo['sisa_akhir'] ?></td>
                    <td><?= $lplpo['stok_optimum'] ?></td>
                    <td><?= $lplpo['permintaan'] ?></td>
                    <td><?= $lplpo['pemberian'] ?></td>
                    <td><?= $lplpo['keterangan'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-danger btn-delete-lplpo" data-toggle="modal" data-target="#hapus-lplpo-<?= $lplpo['kode_obat'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                  </tr>
                  <!-- Modal Hapus  -->
                  <div class="modal fade" id="hapus-lplpo-<?= $lplpo['kode_obat'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Konfirmasi Hapus</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah anda yakin ingin manghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                          <a href="<?= base_url('lplpo/delete') ?>/<?= $lplpo['kode_obat'] ?>" class="btn btn-danger">Hapus</a>
                          <a class="btn btn-default" data-dismiss="modal">Tidak</a>
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