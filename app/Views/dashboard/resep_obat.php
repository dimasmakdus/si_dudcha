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
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Kode Resep</th>
                  <th>Nama Obat</th>
                  <th>Jenis Obat</th>
                  <th>Dosis Aturan Obat</th>
                  <th>Jumlah Obat</th>
                  <th>No Rawat</th>
                  <th>No Rekamedis</th>
                  <th>Tanggal</th>
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
                    <td><?= $resep['no_rawat'] ?></td>
                    <td><?= $resep['no_rekamedis'] ?></td>
                    <td><?= $resep['tanggal'] ?></td>
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
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>