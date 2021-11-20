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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
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
                        <h3 class="card-title">Kelola Data Pengguna</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" action="<?= base_url(); ?>/users/update" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama-lengkap" id="nama-lengkap" value="<?= $getUser['full_name'] ?>" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" value="<?= $getUser['email'] ?>" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">Role Pengguna</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="role" id="role">
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?= $role['id_role'] ?>" <?= $getUser['id_user_role'] == $role['id_role'] ? "selected" : "" ?>><?= $role['nama_role'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">Status Aktif</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="status" id="status">
                                        <?php foreach ($is_active as $key => $value) : ?>
                                            <option value="<?= $key ?>" <?= $getUser['is_active'] == $key ? "selected" : "" ?>><?= $value ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <input type="hidden" name="id_user" id="id_user" value="<?= $getUser['id_user'] ?>">
                        <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan Data</button>
                        <a href="<?= base_url('pengguna') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                    </div>
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>