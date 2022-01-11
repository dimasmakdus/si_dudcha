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
            <a href="<?= base_url('resep-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Kode Resep</th>
                  <th>Nama Obat</th>
                  <th>Jenis Obat</th>
                  <th>Dosis Aturan Obat</th>
                  <th>Jumlah Obat</th>
                  <th>No Rekamedis</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($resep_obat as $resep) : ?>
                  <tr>
                    <td><?= $resep['kode_resep'] ?></td>
                    <td><?= $resep['nama_obat'] ?></td>
                    <td><?= $resep['jenis_obat'] ?></td>
                    <td><?= $resep['dosis_aturan_obat'] ?></td>
                    <td><?= $resep['jumlah_obat'] ?></td>
                    <td><?= $resep['no_rekamedis'] ?></td>
                    <td><?= $resep['tanggal'] ?></td>
                    <td>
                      <a target="_blank" href="<?= base_url('cetak-resep') ?>/<?= $resep['kode_resep'] ?>" class="btn btn-sm bg-info btn-print-resep"><i class="fas fa-print"></i> Cetak</a>
                      <a class="btn btn-sm btn-danger btn-delete-resep" data-toggle="modal" data-target="#hapus-resep-<?= $resep['kode_resep'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                  </tr>
                  <!-- Modal Hapus  -->
                  <div class="modal fade" id="hapus-resep-<?= $resep['kode_resep'] ?>">
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
                          <a href="<?= base_url('resep-obat/delete') ?>/<?= $resep['kode_resep'] ?>" class="btn btn-danger">Hapus</a>
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