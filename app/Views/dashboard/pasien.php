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
                <?= session()->getFlashData('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
            }
            ?>
            <a href="<?= base_url('pasien-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No Rekamedis</th>
                  <th>No KTP</th>
                  <th>No BPJS</th>
                  <th>Nama pasien</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>Status Pasien</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($data_pasien as $pasien) : ?>
                  <tr>
                    <td><?= $pasien['no_rekamedis'] ?></td>
                    <td><?= $pasien['no_ktp'] ?></td>
                    <td><?= $pasien['no_bpjs'] ?></td>
                    <td><?= $pasien['nama_pasien'] ?></td>
                    <td><?= $pasien['jenis_kelamin'] ?></td>
                    <td><?= $pasien['tempat_lahir'] ?></td>
                    <td><?= $pasien['tanggal_lahir'] ?></td>
                    <td><?= $pasien['alamat'] ?></td>
                    <td><?= $pasien['status_pasien'] ?></td>
                    <td>
                      <a href="<?= base_url('pasien') ?>/<?= $pasien['no_rekamedis'] ?>" class="btn btn-sm bg-olive btn-edit-pasien"><i class="fas fa-edit"></i> Ubah</a>

                      <a class="btn btn-sm btn-danger btn-delete-pasien" data-toggle="modal" data-target="#hapus-pasien-<?= $pasien['no_rekamedis'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                  </tr>
                  <!-- Modal Hapus  -->
                  <div class="modal fade" id="hapus-pasien-<?= $pasien['no_rekamedis'] ?>">
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
                        <div class="modal-footer justify-content-between">
                          <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                          <a href="<?= base_url('pasien/delete') ?>/<?= $pasien['no_rekamedis'] ?>" class="btn btn-danger">Hapus</a>
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

<?= $this->endSection('content') ?>