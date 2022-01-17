<!DOCTYPE html>
<html lang="en">

<?= $this->include('templates/style') ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <!-- <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
      <i class="animation__shake fas fa-hospital fa-10x"></i>
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
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="/dist/img/avatar5.png" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?= session()->get('name'); ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <!-- User image -->
            <li class="user-header bg-olive">
              <img src="/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">

              <p>
                <?= session()->get('name'); ?>
                <small><?= session()->get('email'); ?></small>
              </p>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="<?= site_url('logout') ?>" class="btn btn-danger btn-flat float-right"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            </li>
          </ul>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar bg-olive elevation-4">
      <!-- Brand Logo -->
      <a href="<?= site_url('dashboard') ?>" class="brand-link">
        <i class="fas fa-hospital ml-3 mr-2"></i>
        <!-- <img src="<?= base_url() ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light"><b>SIMPBAT PUSMAUNG</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
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
              <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $navLink == 'dashboard' ? 'bg-orange active' : '' ?>">
                <i class="nav-icon fas fa-chart-bar" style="color:white"></i>
                <p style="color:white">Dashboard</p>
              </a>
            </li>

            <li class="nav-header">MASTER DATA</li>
            <li class="nav-item">
              <a href="<?= base_url('supplier') ?>" class="nav-link <?= $navLink == 'supplier' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-box-open nav-icon" style="color:white"></i>
                <p style="color:white">Data Supplier</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('obat-obatan') ?>" class="nav-link <?= $navLink == 'obat-obatan' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-pills nav-icon" style="color:white"></i>
                <p style="color:white">Data Obat</p>
              </a>
            </li>
            <?php if (session()->get('name') == "Administrator") { ?>
              <li class="nav-item">
                <a href="<?= base_url('data-dokter') ?>" class="nav-link <?= $navLink == 'data-dokter' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-users nav-icon" style="color:white"></i>
                  <p style="color:white">Data Dokter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('aturan-obat') ?>" class="nav-link <?= $navLink == 'aturan-obat' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-pills nav-icon" style="color:white"></i>
                  <p style="color:white">Data Aturan Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('barang-masuk') ?>" class="nav-link <?= $navLink == 'barang-masuk' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-truck-loading nav-icon" style="color:white"></i>
                  <p style="color:white">Barang Masuk</p>
                </a>
              </li>
            <?php } ?>

            <?php if (session()->get('name') == "Administrator") { ?>
              <li class="nav-header">PASIEN</li>
              <li class="nav-item">
                <a href="<?= base_url('resep-pasien') ?>" class="nav-link <?= $navLink == 'resep-pasien' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-pills nav-icon" style="color:white"></i>
                  <p style="color:white">Resep Pasien</p>
                </a>
              </li>

              <li class="nav-header">TRANSAKSI</li>
              <li class="nav-item">
                <a href="<?= base_url('pengambilan-obat') ?>" class="nav-link <?= $navLink == 'pengambilan-obat' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-dolly-flatbed nav-icon" style="color:white"></i>
                  <p style="color:white">Pengambilan Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('resep-obat') ?>" class="nav-link <?= $navLink == 'resep-obat' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-paste nav-icon" style="color:white"></i>
                  <p style="color:white">Salinan Resep</p>
                </a>
              </li>

              <li class="nav-header">PENGAJUAN</li>
              <li class="nav-item">
                <a href="<?= base_url('pengajuan-obat') ?>" class="nav-link <?= $navLink == 'pengajuan-obat' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-clipboard-list nav-icon" style="color:white"></i>
                  <p style="color:white">Pengajuan Obat</p>
                </a>
              </li>
            <?php } else { ?>
              <li class="nav-header">PEMESANAN</li>
              <li class="nav-item">
                <a href="<?= base_url('cek-pesanan') ?>" class="nav-link <?= $navLink == 'cek-pesanan' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-dolly-flatbed nav-icon" style="color:white"></i>
                  <p style="color:white">Cek Pemesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('kirim-pesanan') ?>" class="nav-link <?= $navLink == 'kirim-pesanan' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-envelope nav-icon" style="color:white"></i>
                  <p style="color:white">Kirim Pesanan</p>
                </a>
              </li>

              <li class="nav-header">RIWAYAT</li>
              <li class="nav-item">
                <a href="<?= base_url('barang-masuk') ?>" class="nav-link <?= $navLink == 'barang-masuk' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-clipboard-list nav-icon" style="color:white"></i>
                  <p style="color:white">Riwayat Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('resep-obat') ?>" class="nav-link <?= $navLink == 'resep-obat' ? 'bg-orange active' : '' ?>">
                  <i class="fas fa-clipboard-list nav-icon" style="color:white"></i>
                  <p style="color:white">Riwayat Barang Keluar</p>
                </a>
              </li>
            <?php } ?>

            <li class="nav-header">LAPORAN</li>
            <li class="nav-item">
              <a href="<?= base_url('laporan-stok-obat') ?>" class="nav-link <?= $navLink == 'laporan-stok-obat' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-print nav-icon" style="color:white"></i>
                <p style="color:white">Laporan Persediaan Obat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('laporan-masuk') ?>" class="nav-link <?= $navLink == 'laporan-masuk' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-print nav-icon" style="color:white"></i>
                <p style="color:white">Laporan Pemasukan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('laporan-keluar') ?>" class="nav-link <?= $navLink == 'laporan-keluar' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-print nav-icon" style="color:white"></i>
                <p style="color:white">Laporan Pengeluaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('laporan-permintaan') ?>" class="nav-link <?= $navLink == 'laporan-permintaan' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-print nav-icon" style="color:white"></i>
                <p style="color:white">Laporan Permintaan</p>
              </a>
            </li>

            <li class="nav-header">PENGGUNA</li>
            <li class="nav-item">
              <a href="<?= base_url('pengguna') ?>" class="nav-link <?= $navLink == 'pengguna' ? 'bg-orange active' : '' ?>">
                <i class="fas fa-user nav-icon" style="color:white"></i>
                <p style="color:white">Manajemen Pengguna</p>
              </a>
            </li>

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

</body>

</html>