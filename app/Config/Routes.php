<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->post('/login/update-profile', 'Login::updateProfile');
$routes->get('/logout', 'Login::logout');

// Navigasi Dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('/notifikasi', 'Dashboard::notifikasi');
$routes->get('/pengguna', 'Dashboard::kelola_user');
$routes->get('/role-pengguna', 'Dashboard::roleUser');
$routes->get('/resep-pasien', 'Dashboard::resep_pasien');
$routes->get('/aturan-barang', 'Dashboard::aturan_barang');
$routes->get('/supplier', 'Dashboard::supplier');
$routes->get('/outlet', 'Dashboard::outlet');
$routes->get('/data-barang', 'Dashboard::data_barang');
$routes->get('/satuan-barang', 'Dashboard::satuan_barang');
$routes->get('/jenis-barang', 'Dashboard::jenis_barang');
$routes->get('/data-dokter', 'Dashboard::data_dokter');
$routes->get('/stok-barang', 'Dashboard::stok_barang');
$routes->get('/resep-barang', 'Dashboard::resep_barang');
$routes->get('/pengajuan-barang', 'Dashboard::pesanan_barang');
$routes->get('/data-dokter', 'Dashboard::data_dokter');
$routes->get('/penjualan-barang', 'Dashboard::penjualan_barang');
$routes->get('/riwayat-penjualan-barang', 'Dashboard::riwayat_penjualan_barang');
$routes->get('/laporan-stok-barang', 'Laporan::laporan_stok_barang');
$routes->get('/laporan-masuk', 'Laporan::laporan_masuk');
$routes->get('/laporan-keluar', 'Laporan::laporan_keluar');
$routes->get('/laporan-permintaan', 'Laporan::laporan_permintaan');
$routes->get('/laporan-kadaluarsa', 'Laporan::laporan_kadaluarsa');
$routes->get('/kirim-pesanan', 'PesananBarang::kirimPesanan');
$routes->get('/cek-pesanan', 'PesananBarang::cekPesanan');
$routes->get('/barang-masuk', 'Dashboard::barang_masuk');

// Laporan
$routes->get('/cetak-lpo', 'Laporan::cetak_lpo');
$routes->get('/cetak-lbm', 'Laporan::cetak_lbm');
$routes->get('/cetak-lbk', 'Laporan::cetak_lbk');
$routes->get('/cetak-lpb', 'Laporan::cetak_lpb');
$routes->get('/cetak-lkd', 'Laporan::cetak_lkd');
$routes->get('/cetak-pesanan/(:segment)', 'Laporan::cetakPesanan/$1');
$routes->get('/cetak-permintaan', 'Laporan::cetak_permintaan');

// Pengguna
$routes->get('/user-form', 'Users::userForm');
$routes->get('/pengguna/(:segment)', 'Users::userEdit/$1');
$routes->post('/pengguna/create', 'Users::create');
$routes->post('/pengguna/update', 'Users::update');
$routes->get('/pengguna/delete/(:segment)', 'Users::remove/$1');
$routes->post('/pengguna/updatePassword', 'Users::updatePassword');

// Pemakaian Barang (Aturan Barang)
$routes->post('/aturan-barang/create', 'AturanBarang::create');
$routes->post('/aturan-barang/update', 'AturanBarang::update');
$routes->get('/aturan-barang/remove/(:segment)', 'AturanBarang::remove/$1');

// Dokter
$routes->post('/data-dokter/create', 'Dokter::create');
$routes->post('/data-dokter/update', 'Dokter::update');
$routes->get('/data-dokter/remove/(:segment)', 'Dokter::remove/$1');

// Role
$routes->get('/role-form', 'Dashboard::roleForm');
$routes->get('/role-pengguna/akses/(:segment)', 'Dashboard::viewAkses/$1');
$routes->post('/role/create', 'HakAkses::create');
$routes->get('/role-pengguna/delete/(:segment)', 'HakAkses::remove/$1');

// Supplier
$routes->get('/supplier-add', 'Supplier::supplierAdd');
$routes->get('/supplier/(:segment)', 'Supplier::supplierEdit/$1');

// Outlet
$routes->post('/outlet/create', 'Outlet::create');
$routes->post('/outlet/update', 'Outlet::update');

// Satuan Barang
$routes->post('/satuan-barang/create', 'SatuanBarang::create');
$routes->post('/satuan-barang/update', 'SatuanBarang::update');
$routes->get('/satuan-barang/remove/(:segment)', 'SatuanBarang::remove/$1');

// Jenis Barang
$routes->post('/jenis-barang/create', 'JenisBarang::create');
$routes->post('/jenis-barang/update', 'JenisBarang::update');
$routes->get('/jenis-barang/remove/(:segment)', 'JenisBarang::remove/$1');

// Data Barang
$routes->get('/data-barang-add', 'DataBarang::barangAdd');
$routes->get('/data-barang/(:segment)', 'DataBarang::barangEdit/$1');
$routes->post('/data-barang/create', 'DataBarang::create');
$routes->post('/data-barang/update', 'DataBarang::update');
$routes->get('/data-barang/delete/(:segment)', 'DataBarang::remove/$1');

// Stok Barang
$routes->get('/stok-barang-add', 'StokBarang::stokAdd');
$routes->post('/stok-barang/create', 'StokBarang::create');

// Penjualan Barang
$routes->get('/penjualan-add', 'PenjualanBarang::penjualanAdd');
$routes->get('/cetak-penjualan/(:segment)', 'PenjualanBarang::cetakPenjualan/$1');
$routes->post('/penjualan-barang/create', 'PenjualanBarang::create');
$routes->post('/salinan-penjualan/create', 'PenjualanBarang::postSalinanPenjualan');
$routes->get('/penjualan-barang/delete/(:segment)', 'PenjualanBarang::remove/$1');
$routes->get('/cetak-nota/(:segment)', 'PenjualanBarang::cetakNota/$1');

// Permintaan Barang
$routes->get('/cek-pesanan/delete/(:segment)', 'PesananBarang::remove/$1');

// Pesanan Barang
$routes->get('/data-barang-pesanan/(:segment)', 'PesananBarang::dataBarangPesanan/$1');
$routes->get('/pesanan-barang-add', 'PesananBarang::pesananAdd');
$routes->get('/cek-pesanan-edit/(:segment)', 'PesananBarang::pesananEdit/$1');
$routes->post('/pesanan-barang/create', 'PesananBarang::create');
$routes->post('/pesanan-barang/update', 'PesananBarang::update');
$routes->get('/pesanan-barang/delete/(:segment)', 'PesananBarang::remove/$1');
$routes->post('/kirim-email', 'PesananBarang::kirim_email');

// Bukti Barang Keluar
$routes->get('/barang-masuk-add', 'BarangMasuk::barang_masuk_add');
$routes->post('/barang-masuk/create', 'BarangMasuk::create');
$routes->get('/barang-masuk/updatePembayaran/(:segment)', 'BarangMasuk::updatePembayaran/$1');
$routes->get('/cetak-kuitansi', 'BarangMasuk::cetakKuitansi');

// Pengeluaran Barang
$routes->get('/pengeluaran-harian-add', 'pengeluaranHarian::pengeluaranAdd');
$routes->get('/cetak-lpho', 'pengeluaranHarian::cetakLPHO');
$routes->post('/pengeluaran-harian/create', 'pengeluaranHarian::create');
$routes->get('/pengeluaran-harian/delete/(:segment)', 'pengeluaranHarian::remove/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
