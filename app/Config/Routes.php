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
$routes->get('/pasien', 'Dashboard::pasien');
$routes->get('/supplier', 'Dashboard::supplier');
$routes->get('/obat-obatan', 'Dashboard::obat_obatan');
$routes->get('/stok-obat', 'Dashboard::stok_obat');
$routes->get('/resep-obat', 'Dashboard::resep_obat');
$routes->get('/permintaan-obat', 'Dashboard::permintaan_obat');
$routes->get('/pengeluaran-harian', 'Dashboard::pengeluaran_harian');
$routes->get('/laporan-barang-keluar', 'Dashboard::laporan_barang_keluar');

// Pengguna
$routes->get('/user-form', 'Users::userForm');
$routes->get('/pengguna/(:segment)', 'Users::userEdit/$1');
$routes->post('/pengguna/create', 'Users::create');
$routes->post('/pengguna/update', 'Users::update');
$routes->get('/pengguna/delete/(:segment)', 'Users::remove/$1');

// Pasien
$routes->get('/pasien-add', 'Pasien::pasienAdd');
$routes->get('/pasien/(:segment)', 'Pasien::pasienEdit/$1');

// Supplier
$routes->get('/supplier-add', 'Supplier::supplierAdd');
$routes->get('/supplier/(:segment)', 'Supplier::supplierEdit/$1');

// Obat-obatan
$routes->get('/obat-obatan-add', 'ObatObatan::obatAdd');
$routes->get('/obat-obatan/(:segment)', 'ObatObatan::obatEdit/$1');

// Stok Obat
$routes->get('/stok-obat-add', 'StokObat::stokAdd');
$routes->get('/stok-obat/(:segment)', 'StokObat::stokEdit/$1');

// Permintaan Obat
$routes->get('/permintaan-obat-add', 'PermintaanObat::permintaanAdd');
$routes->get('/permintaan-obat/(:segment)', 'PermintaanObat::permintaanEdit/$1');

// Pengeluaran Obat
$routes->get('/pengeluaran-harian-add', 'pengeluaranHarian::pengeluaranAdd');
$routes->get('/pengeluaran-harian/(:segment)', 'pengeluaranHarian::pengeluaranEdit/$1');
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
