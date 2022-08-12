<!DOCTYPE html>
<html lang="en">

<?= $this->include('templates/style') ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <!-- <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
      <i class="animation__shake fas fa-warehouse fa-10x"></i>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <?php
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_notifikasi');
        $notifikasi   = $builder->where('notifikasi_user_id', session()->get('id_user'))->orderBy('notifikasi_tanggal', 'DESC')->limit(5)->get()->getResult();
        $jumlahNotifikasi = $builder->where('notifikasi_user_id', session()->get('id_user'))->orderBy('notifikasi_tanggal', 'DESC')->get()->getResult()
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge"><?= count($jumlahNotifikasi) != 0 ? count($jumlahNotifikasi) : '' ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">

            <?php if (count($notifikasi) > 0) { ?>
              <?php foreach ($notifikasi as $notif) : ?>
                <a href="<?= base_url($notif->notifikasi_url) ?>" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <!-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                    <i class="fas fa-bell mr-3 mt-1"></i>
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        <?= $notif->notifikasi_judul ?>
                      </h3>
                      <p class="text-sm"><?= $notif->notifikasi_pesan ?></p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
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
                      </p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
              <?php endforeach ?>

              <a href="<?= base_url('notifikasi') ?>" class="dropdown-item dropdown-footer">See All Notification</a>
            <?php } else { ?>
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title p-3 text-center">
                    Tidak Ada Notifikasi
                  </h3>
                  </p>
                </div>
              </div>
            <?php } ?>
          </div>
        </li>

        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?= session()->get('user_photo') != null ? 'uploads/users/' . session()->get('user_photo') : '/dist/img/avatar-admin.png' ?>" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?= session()->get('name'); ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <!-- User image -->
            <li class="user-header bg-dark">
              <img src="<?= session()->get('user_photo') != null ? 'uploads/users/' . session()->get('user_photo') : '/dist/img/avatar-admin.png' ?>" class="img-circle elevation-2" alt="User Image">

              <p>
                <?= session()->get('name'); ?>
                <small><?= session()->get('email'); ?></small>
              </p>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
              <button class="btn btn-sm btn-default float-left" data-toggle="modal" data-target="#edit-user"><i class="fas fa-cog"></i> Ubah Profil</button>
              <a href="<?= site_url('logout') ?>" class="btn btn-sm btn-danger float-right"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Modal Ubah Profil-->
    <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <form class="form-horizontal" action="<?= base_url('login/update-profile'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Profil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?= csrf_field(); ?>
              <div class="form-group row">
                <label for="nama-barang" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-10">
                  <input type="email" class="form-control" name="email" id="emailEdit" value="<?= session()->get('email'); ?>" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="kode-barang" class="col-md-2 col-form-label">Nama Lengkap</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="full_name" id="fullNameEdit" value="<?= session()->get('name'); ?>" placeholder="Nama Lengkap" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="kode-barang" class="col-md-2 col-form-label">Foto</label>
                <img src="<?= session()->get('user_photo') != null ? 'uploads/users/' . session()->get('user_photo') : '/dist/img/avatar-admin.png' ?>" class="col-sm-2" id="previewPhoto" alt="User Image">
                <div class="col-md-8">
                  <input type="file" class="form-control" name="user_photo" id="userPhoto">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="form-control" name="id_user" value="<?= session()->get('id_user'); ?>">
              <button type="submit" class="btn bg-olive"><i class="fas fa-save"></i> Simpan Perubahan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetEditUser()"><i class="fas fa-sign-out-alt"></i> Kembali</button>
            </div>
        </div>
        </form>
      </div>
    </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= site_url('dashboard') ?>" class="brand-link text-center">
        <h4 class="brand-text font-weight-light">
          <b>INVENTORY DUDCHAICE</b>
        </h4>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $navLink == 'dashboard' ? 'bg-olive active' : '' ?>">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <?php if (session()->get('id_user') == 1 || session()->get('id_user') == 2) : ?>
              <!-- <li class="nav-header">MASTER DATA</li> -->
              <li class="nav-item <?= $navLink == 'supplier' || $navLink == 'outlet' || $navLink == 'satuan-barang' || $navLink == 'jenis-barang' ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $navLink == 'supplier' || $navLink == 'outlet' || $navLink == 'satuan-barang' || $navLink == 'jenis-barang' ? 'bg-olive active' : '' ?>">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Data Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview px-2">
                  <li class="nav-item">
                    <a href="<?= base_url('supplier') ?>" class="nav-link <?= $navLink == 'supplier' ? 'bg-olive active' : '' ?>">
                      <i class="fas fa-truck nav-icon"></i>
                      <p>Data Supplier</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('outlet') ?>" class="nav-link <?= $navLink == 'outlet' ? 'bg-olive active' : '' ?>">
                      <i class="fas fa-store nav-icon"></i>
                      <p>Data Outlet</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('satuan-barang') ?>" class="nav-link <?= $navLink == 'satuan-barang' ? 'bg-olive active' : '' ?>">
                      <i class="fas fa-inbox nav-icon"></i>
                      <p>Satuan Barang</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('jenis-barang') ?>" class="nav-link <?= $navLink == 'jenis-barang' ? 'bg-olive active' : '' ?>">
                      <i class="fas fa-boxes nav-icon"></i>
                      <p>Jenis Barang</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header">PERSEDIAAN</li>
              <li class="nav-item">
                <a href="<?= base_url('data-barang') ?>" class="nav-link <?= $navLink == 'data-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-archive nav-icon"></i>
                  <p>Stok Barang</p>
                </a>
              </li>
            <?php endif ?>

            <?php if (session()->get('id_user') == 1) { ?>
              <li class="nav-header">PENGEMASAN</li>
              <li class="nav-item">
                <a href="<?= base_url('barang-masuk-add') ?>" class="nav-link <?= $navLink == 'pengemasan-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Pengemasan Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('barang-masuk') ?>" class="nav-link <?= $navLink == 'barang-masuk' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-truck-loading nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="<?= base_url('data-dokter') ?>" class="nav-link <?= $navLink == 'data-dokter' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Data Dokter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('aturan-barang') ?>" class="nav-link <?= $navLink == 'aturan-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-pills nav-icon"></i>
                  <p>Data Aturan Barang</p>
                </a>
              </li> -->
            <?php } ?>

            <?php if (session()->get('id_user') == 1) { ?>
              <!-- <li class="nav-header">PASIEN</li>
              <li class="nav-item">
                <a href="<?= base_url('resep-pasien') ?>" class="nav-link <?= $navLink == 'resep-pasien' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-pills nav-icon"></i>
                  <p>Resep Pasien</p>
                </a>
              </li> -->

              <li class="nav-header">TRANSAKSI</li>
              <li class="nav-item">
                <a href="<?= base_url('penjualan-barang') ?>" class="nav-link <?= $navLink == 'penjualan-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Tambah Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('riwayat-penjualan-barang') ?>" class="nav-link <?= $navLink == 'riwayat-penjualan-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>

              <li class="nav-header">PENGAJUAN</li>
              <li class="nav-item">
                <a href="<?= base_url('pengajuan-barang') ?>" class="nav-link <?= $navLink == 'pengajuan-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Pengajuan Barang</p>
                </a>
              </li>
            <?php } ?>
            <?php if (session()->get('id_user') == 2) : ?>
              <li class="nav-header">PEMESANAN</li>
              <li class="nav-item">
                <a href="<?= base_url('cek-pesanan') ?>" class="nav-link <?= $navLink == 'cek-pesanan' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-dolly-flatbed nav-icon"></i>
                  <p>Cek Pengajuan</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?= base_url('kirim-pesanan') ?>" class="nav-link <?= $navLink == 'kirim-pesanan' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-envelope nav-icon"></i>
                  <p>Kirim Pesanan</p>
                </a>
              </li> -->

              <li class="nav-header">RIWAYAT</li>
              <li class="nav-item">
                <a href="<?= base_url('barang-masuk') ?>" class="nav-link <?= $navLink == 'barang-masuk' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p class="text-center">Riwayat Pembelian / Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('riwayat-penjualan-barang') ?>" class="nav-link <?= $navLink == 'riwayat-penjualan-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Riwayat Penjualan / Barang Keluar</p>
                </a>
              </li>
            <?php endif ?>

            <?php if (session()->get('id_user') != 3) : ?>
              <li class="nav-header">LAPORAN</li>
              <li class="nav-item">
                <a href="<?= base_url('laporan-stok-barang') ?>" class="nav-link <?= $navLink == 'laporan-stok-barang' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-print nav-icon"></i>
                  <p>Laporan Persediaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan-masuk') ?>" class="nav-link <?= $navLink == 'laporan-masuk' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-print nav-icon"></i>
                  <p>Laporan Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('laporan-keluar') ?>" class="nav-link <?= $navLink == 'laporan-keluar' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-print nav-icon"></i>
                  <p>Laporan Penjualan</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?= base_url('laporan-permintaan') ?>" class="nav-link <?= $navLink == 'laporan-permintaan' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-print nav-icon"></i>
                  <p>Laporan Pengajuan</p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
              <a href="<?= base_url('laporan-kadaluarsa') ?>" class="nav-link <?= $navLink == 'laporan-kadaluarsa' ? 'bg-olive active' : '' ?>">
                <i class="fas fa-print nav-icon"></i>
                <p>Laporan Kadaluarsa</p>
              </a>
            </li> -->
            <?php endif ?>

            <?php if (session()->get('id_user') == 2) : ?>
              <li class="nav-header">PENGGUNA</li>
              <li class="nav-item">
                <a href="<?= base_url('pengguna') ?>" class="nav-link <?= $navLink == 'pengguna' ? 'bg-olive active' : '' ?>">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Manajemen Pengguna</p>
                </a>
              </li>
            <?php endif ?>

            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <?= $this->renderSection('content') ?>

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script>
    document.getElementById('userPhoto').addEventListener("change", changePhoto)

    function changePhoto() {
      const [file] = document.getElementById('userPhoto').files
      if (file) {
        document.getElementById('previewPhoto').src = URL.createObjectURL(file)
      }
    }

    function resetEditUser() {
      document.getElementById('emailEdit').value = "<?= session()->get('email'); ?>";
      document.getElementById('fullNameEdit').value = "<?= session()->get('name'); ?>";
      document.getElementById('userPhoto').value = null;
      document.getElementById('previewPhoto').src = "<?= session()->get('user_photo') != null ? 'uploads/users/' . session()->get('user_photo') : '/dist/img/avatar-admin.png' ?>";
    }
  </script>
</body>

</html>