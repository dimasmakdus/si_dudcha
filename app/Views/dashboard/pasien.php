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
                </button>
              </div>
            <?php
            }
            ?>
            <a class="btn bg-olive mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</a>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Resep</th>
                  <th>Status Pasien</th>
                  <th>No BPJS</th>
                  <th>Nama pasien</th>
                  <th>Jenis Kelamin</th>
                  <th>Umur</th>
                  <th>Alamat</th>
                  <th>Nama Dokter</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($data_pasien as $pasien) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= "RP" . $pasien['no_resep'] ?></td>
                    <td><?= $pasien['status_pasien'] ?></td>
                    <td><?= $pasien['no_bpjs'] ?></td>
                    <td><?= $pasien['nama_pasien'] ?></td>
                    <td><?= $pasien['jenis_kelamin'] ?></td>
                    <td><?= $pasien['umur'] ?></td>
                    <td><?= $pasien['alamat'] ?></td>
                    <td><?= $pasien['nama_dokter'] ?></td>
                    <td>
                      <a class="btn btn-sm bg-olive btn-edit-pasien" data-toggle="modal" data-target="#edit-<?= $pasien['no_resep'] ?>"><i class="fas fa-edit"></i> Ubah</a>
                      <a class="btn btn-sm btn-danger btn-delete-pasien" data-toggle="modal" data-target="#hapus-<?= $pasien['no_resep'] ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                  </tr>
                  <!-- Modal Hapus  -->
                  <div class="modal fade" id="hapus-<?= $pasien['no_resep'] ?>">
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
                          <a href="<?= base_url('pasien/delete') ?>/<?= $pasien['no_resep'] ?>" class="btn btn-danger">Hapus</a>
                          <a class="btn btn-default" data-dismiss="modal">Tidak</a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                  <!-- Modal Edit -->
                  <div class="modal fade" id="edit-<?= $pasien['no_resep'] ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form class="form-horizontal" action="<?= base_url('pasien/update'); ?>" method="POST">
                          <div class="modal-header">
                            <h4 class="modal-title">Ubah Data Resep Pasien</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                              <label for="no_resep" class="col-sm-2 col-form-label">No Resep</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= "RP" . $pasien['no_resep'] ?>" placeholder="No Resep" disabled>
                                <input type="hidden" class="form-control" name="no_resep" value="<?= $pasien['no_resep'] ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="status_pasien" class="col-sm-2 col-form-label">Status Pasien *</label>
                              <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="status_pasien" required>
                                  <option value="" disabled>-- Status Pasien --</option>
                                  <?php foreach ($status_pasien as $value) : ?>
                                    <option value="<?= $value ?>" <?= $value == $pasien['status_pasien'] ? 'selected' : '' ?>><?= $value ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="no_bpjs" class="col-sm-2 col-form-label">No BPJS *</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" name="no_bpjs" value="<?= $pasien['no_bpjs'] ?>" placeholder="-">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_pasien" value="<?= $pasien['nama_pasien'] ?>" placeholder="Nama Pasien" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                              <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="jenis_kelamin" required>
                                  <option value="" disabled>-- Jenis Kelamin --</option>
                                  <?php foreach ($jenis_kelamin as $kelamin) : ?>
                                    <option value="<?= $kelamin ?>" <?= $kelamin == $pasien['jenis_kelamin'] ? 'selected' : '' ?>><?= $kelamin ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" name="umur" value="<?= $pasien['umur'] ?>" placeholder="00" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="nama_dokter" class="col-sm-2 col-form-label">Nama Dokter</label>
                              <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="nama_dokter" required>
                                  <option value="" disabled>-- Cari Dokter --</option>
                                  <?php foreach ($db_dokter as $dokter) : ?>
                                    <option value="<?= $dokter['nama_dokter'] ?>" <?= $dokter['nama_dokter'] == $pasien['nama_dokter'] ? 'selected' : '' ?>><?= $dokter['nama_dokter'] ?> (<?= $dokter['poli'] ?>)</option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" row="3" name="alamat" placeholder="Alamat" required><?= $pasien['alamat'] ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan</button>
                            <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->

                  <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Modal Tambah -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form class="form-horizontal" action="<?= base_url('pasien/create'); ?>" method="POST">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Resep Pasien</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="no_resep" class="col-sm-2 col-form-label">No Resep</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?= "RP" . $kode_baru ?>" placeholder="No Resep" disabled>
                      <input type="hidden" class="form-control" name="no_resep" value="<?= $kode_baru ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status_pasien" class="col-sm-2 col-form-label">Status Pasien *</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="status_pasien" id="statusPasien" required>
                        <option value="" selected disabled>-- Status Pasien --</option>
                        <?php foreach ($status_pasien as $pasien) : ?>
                          <option value="<?= $pasien ?>"><?= $pasien ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row is-bpjs">
                    <label for="no_bpjs" class="col-sm-2 col-form-label">No BPJS *</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="no_bpjs" id="no-bpjs" placeholder="00000000000000">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_pasien" placeholder="Nama Pasien" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="jenis_kelamin" required>
                        <option value="" selected disabled>-- Jenis Kelamin --</option>
                        <?php foreach ($jenis_kelamin as $kelamin) : ?>
                          <option value="<?= $kelamin ?>"><?= $kelamin ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="umur" placeholder="00" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama_dokter" class="col-sm-2 col-form-label">Nama Dokter</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="nama_dokter" required>
                        <option value="" selected disabled>-- Cari Dokter --</option>
                        <?php foreach ($db_dokter as $dokter) : ?>
                          <option value="<?= $dokter['nama_dokter'] ?>"><?= $dokter['nama_dokter'] ?> (<?= $dokter['poli'] ?>)</option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" row="3" name="alamat" placeholder="Alamat" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Tambah</button>
                  <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->include('templates/script') ?>
<script>
  $('.is-bpjs').hide();
  $('#statusPasien').change(function() {
    var status_pasien = $('select[id=statusPasien] option').filter(':selected').val();
    if (status_pasien == "BPJS") {
      $('.is-bpjs').show();
      document.getElementById("no-bpjs").required = true;
    } else {
      $('.is-bpjs').hide();
      document.getElementById("no-bpjs").required = false;
    }
  });
</script>
<?= $this->endSection('content') ?>