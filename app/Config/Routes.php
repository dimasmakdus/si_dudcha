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
$routes->get('/logout', 'Login::logout');

// Navigasi Dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('/pengguna', 'Dashboard::kelola_user');
$routes->get('/role-pengguna', 'Dashboard::roleUser');
$routes->get('/resep-pasien', 'Dashboard::resep_pasien');
$routes->get('/aturan-obat', 'Dashboard::aturan_obat');
$routes->get('/supplier', 'Dashboard::supplier');
$routes->get('/obat-obatan', 'Dashboard::obat_obatan');
$routes->get('/data-dokter', 'Dashboard::data_dokter');
$routes->get('/stok-obat', 'Dashboard::stok_obat');
$routes->get('/resep-obat', 'Dashboard::resep_obat');
$routes->get('/pengajuan-obat', 'Dashboard::pesanan_obat');
$routes->get('/data-dokter', 'Dashboard::data_dokter');
$routes->get('/pengambilan-obat', 'Dashboard::pengambilan_obat');
$routes->get('/laporan-stok-obat', 'Laporan::laporan_stok_obat');
$routes->get('/laporan-masuk', 'Laporan::laporan_masuk');
$routes->get('/laporan-keluar', 'Laporan::laporan_keluar');
$routes->get('/laporan-permintaan', 'Laporan::laporan_permintaan');
$routes->get('/kirim-pesanan', 'PesananObat::kirimPesanan');
$routes->get('/cek-pesanan', 'PesananObat::cekPesanan');
$routes->get('/barang-masuk', 'Dashboard::barang_masuk');

// Laporan
$routes->get('/cetak-lpo', 'Laporan::cetak_lpo');
$routes->get('/cetak-lbm', 'Laporan::cetak_lbm');
$routes->get('/cetak-lbk', 'Laporan::cetak_lbk');
$routes->get('/cetak-lpb', 'Laporan::cetak_lpb');
$routes->get('/cetak-pesanan/(:segment)', 'Laporan::cetakPesanan/$1');
$routes->get('/cetak-permintaan', 'Laporan::cetak_permintaan');

// Pengguna
$routes->get('/user-form', 'Users::userForm');
$routes->get('/pengguna/(:segment)', 'Users::userEdit/$1');
$routes->post('/pengguna/create', 'Users::create');
$routes->post('/pengguna/update', 'Users::update');
$routes->get('/pengguna/delete/(:segment)', 'Users::remove/$1');

// Pemakaian Obat (Aturan Obat)
$routes->post('/aturan-obat/create', 'AturanObat::create');
$routes->post('/aturan-obat/update', 'AturanObat::update');
$routes->get('/aturan-obat/remove/(:segment)', 'AturanObat::remove/$1');

// Dokter
$routes->post('/data-dokter/create', 'Dokter::create');
$routes->post('/data-dokter/update', 'Dokter::update');
$routes->get('/data-dokter/remove/(:segment)', 'Dokter::remove/$1');

// Role
$routes->get('/role-form', 'Dashboard::roleForm');
$routes->get('/role-pengguna/akses/(:segment)', 'Dashboard::viewAkses/$1');
$routes->post('/role/create', 'HakAkses::create');
$routes->get('/role-pengguna/delete/(:segment)', 'HakAkses::remove/$1');

// Pasien
$routes->post('/pasien/create', 'Pasien::create');
$routes->post('/pasien/update', 'Pasien::update');
$routes->get('/pasien/delete/(:segment)', 'Pasien::remove/$1');

// Supplier
$routes->get('/supplier-add', 'Supplier::supplierAdd');
$routes->get('/supplier/(:segment)', 'Supplier::supplierEdit/$1');

// Obat-obatan
$routes->get('/obat-obatan-add', 'ObatObatan::obatAdd');
$routes->get('/obat-obatan/(:segment)', 'ObatObatan::obatEdit/$1');
$routes->post('/obat-obatan/create', 'ObatObatan::create');
$routes->post('/obat-obatan/update', 'ObatObatan::update');
$routes->get('/obat-obatan/delete/(:segment)', 'ObatObatan::remove/$1');

// Stok Obat
$routes->get('/stok-obat-add', 'StokObat::stokAdd');
$routes->post('/stok-obat/create', 'StokObat::create');

// Resep Obat
$routes->get('/resep-add', 'ResepObat::resepAdd');
$routes->get('/cetak-resep/(:segment)', 'ResepObat::cetakResep/$1');
$routes->post('/resep-obat/create', 'ResepObat::create');
$routes->get('/resep-obat/delete/(:segment)', 'ResepObat::remove/$1');

// Permintaan Obat / LPLPO
$routes->get('/permintaan-obat-add', 'PermintaanObat::permintaanAdd');
$routes->get('/cetak-lplpo', 'PermintaanObat::cetakLPLPO');
$routes->post('/lplpo/create', 'PermintaanObat::create');
$routes->get('/lplpo/delete/(:segment)', 'PermintaanObat::remove/$1');

// Pesanan Obat
$routes->get('/pesanan-obat-add', 'PesananObat::pesananAdd');
$routes->get('/cek-pesanan-edit/(:segment)', 'PesananObat::pesananEdit/$1');
$routes->post('/pesanan-obat/create', 'PesananObat::create');
$routes->post('/pesanan-obat/update', 'PesananObat::update');
$routes->get('/pesanan-obat/delete/(:segment)', 'PesananObat::remove/$1');
$routes->post('/kirim-email', 'PesananObat::kirim_email');

// Bukti Barang Keluar
$routes->get('/barang-masuk-add', 'BarangMasuk::barang_masuk_add');
$routes->post('/barang-masuk/create', 'BarangMasuk::create');

// Pengeluaran Obat
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
