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
                                    <th>Judul</th>
                                    <th>Pesan</th>
                                    <th>Waktu</th>
                                    <th>Moment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($notifikasi as $notif) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $notif->notifikasi_judul ?></td>
                                        <td><?= $notif->notifikasi_pesan ?></td>
                                        <td><?= $notif->notifikasi_tanggal ?></td>
                                        <td>
                                            <?php
                                            $seconds_ago = (time() - strtotime($notif->notifikasi_tanggal));

                                            if ($seconds_ago >= 31536000) {
                                                echo intval($seconds_ago / 31536000) . " tahun yang lalu";
                                            } elseif ($seconds_ago >= 2419200) {
                                                echo intval($seconds_ago / 2419200) . " bulan yang lalu";
                                            } elseif ($seconds_ago >= 86400) {
                                                echo intval($seconds_ago / 86400) . " hari yang lalu";
                                            } elseif ($seconds_ago >= 3600) {
                                                echo intval($seconds_ago / 3600) . " jam yang lalu";
                                            } elseif ($seconds_ago >= 60) {
                                                echo intval($seconds_ago / 60) . " menit yang lalu";
                                            } else {
                                                echo "Kurang dari satu menit yang lalu";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url($notif->notifikasi_url) ?>" class="btn btn-sm bg-olive"><i class="fas fa-bell"></i> </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->



            </div>
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