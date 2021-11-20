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
            <a href="<?= base_url('permintaan-obat-add') ?>" class="btn bg-olive mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Transaksi</th>
                  <th>Supplier</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Jenis Obat</th>
                  <th>Harga Beli</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Keterangan</th>
                  <th>Total</th>
                  <th>Tgl Transaksi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($permintaan_obat as $permintaan) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $permintaan['no_trans'] ?></td>
                    <td><?= $permintaan['supplier'] ?></td>
                    <td><?= $permintaan['kode_obat'] ?></td>
                    <td><?= $permintaan['nama_obat'] ?></td>
                    <td><?= $permintaan['jenis_obat'] ?></td>
                    <td><?= $permintaan['harga_beli'] ?></td>
                    <td><?= $permintaan['jumlah'] ?></td>
                    <td><?= $permintaan['satuan'] ?></td>
                    <td><?= $permintaan['keterangan'] ?></td>
                    <td><?= $permintaan['total'] ?></td>
                    <td><?= $permintaan['tgl_transaksi'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-danger btn-delete-permintaan" data-toggle="modal" data-target="#hapus-permintaan-<?= $permintaan['id_permintaan'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                  </tr>
                  <!-- Modal Hapus  -->
                  <div class="modal fade" id="hapus-permintaan-<?= $permintaan['id_permintaan'] ?>">
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
                          <a href="<?= base_url('') ?>/<?= $permintaan['id_permintaan'] ?>" class="btn btn-danger">Hapus</a>
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