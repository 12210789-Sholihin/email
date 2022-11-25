<?php

namespace Config;

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->post('/home/simpan', Home::class);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set $autoRoutesImproved to true in app/Config/Feature.php and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('login', function(RouteCollection $routes){
    $routes->get('lupa', 'KaryawanController::viewLupaPassword');
    $routes->get('/', 'KaryawanController::viewLogin');
    $routes->post('/', 'KaryawanController::login');
    $routes->delete('/', 'KaryawanController::logout');
    $routes->patch('/', 'KaryawanController::lupaPassword');
    
});

$routes->group('karyawan', function(RouteCollection $routes){
    $routes->get('/', 'KaryawanController::index');
    $routes->post('/', 'KaryawanController::store');
    $routes->patch('/', 'KaryawanController::update');
    $routes->delete('/', 'KaryawanController::delete');
    $routes->get('(:num)', 'KaryawanController::show/$1');
    $routes->get('all', 'KaryawanController::all');
});

$routes->group('pelanggan', function(RouteCollection $routes){
    $routes->get('/', 'PelangganController::index');
    $routes->post('/', 'PelangganController::store');
    $routes->patch('/', 'PelangganController::update');
    $routes->delete('/', 'PelangganController::delete');
    $routes->get('(:num)', 'PelangganController::show/$1');
    $routes->get('all', 'PelangganController::all');
});

$routes->group('jeniskendaraan', function(RouteCollection $routes){
    $routes->get('/', 'JenisKendaraanController::index');
    $routes->post('/', 'JenisKendaraanController::store');
    $routes->patch('/', 'JenisKendaraanController::update');
    $routes->delete('/', 'JenisKendaraanController::delete');
    $routes->get('(:num)', 'JenisKendaraanfController::show/$1');
    $routes->get('all', 'JenisKendaraanController::all');
});

$routes->group('warnakendaraan', function(RouteCollection $routes){
    $routes->get('/', 'WarnaKendaraanController::index');
    $routes->post('/', 'WarnaKendaraanController::store');
    $routes->patch('/', 'WarnaKendaraanController::update');
    $routes->delete('/', 'WarnaKendaraanController::delete');
    $routes->get('(:num)', 'WarnaKendaraanController::show/$1');
    $routes->get('all', 'WarnaKendaraanController::all');
});

$routes->group('statuspemeriksaan', function(RouteCollection $routes){
    $routes->get('/', 'StatusPemeriksaanController::index');
    $routes->post('/', 'StatusPemeriksaanController::store');
    $routes->patch('/', 'StatusPemeriksaanController::update');
    $routes->delete('/', 'StatusPemeriksaanController::delete');
    $routes->get('(:num)', 'StatusPemeriksaanController::show/$1');
    $routes->get('all', 'StatusPemeriksaanController::all');
});
$routes->group('kendaraan', function(RouteCollection $routes){
    $routes->get('/', 'KendaraanController::index');
    $routes->post('/', 'KendaraanController::store');
    $routes->patch('/', 'KendaraanController::update');
    $routes->delete('/', 'KendaraanController::delete');
    $routes->get('(:num)', 'KendaraanController::show/$1');
    $routes->get('all', 'KendaraanController::all');
});
$routes->group('pemeriksaan', function(RouteCollection $routes){
    $routes->get('/', 'PemeriksaanController::index');
    $routes->post('/', 'PemeriksaanController::store');
    $routes->patch('/', 'PemeriksaanController::update');
    $routes->delete('/', 'PemeriksaanController::delete');
    $routes->get('(:num)', 'PemeriksaanController::show/$1');
    $routes->get('all', 'PemeriksaanController::all');
});
$routes->group('metodebayar', function(RouteCollection $routes){
    $routes->get('/', 'MetodeBayarController::index');
    $routes->post('/', 'MetodeBayarController::store');
    $routes->patch('/', 'MetodeBayarController::update');
    $routes->delete('/', 'MetodeBayarController::delete');
    $routes->get('(:num)', 'MetodeBayarController::show/$1');
    $routes->get('all', 'MetodeBayarController::all');
});
$routes->group('unitsatuan', function(RouteCollection $routes){
    $routes->get('/', 'UnitSatuanController::index');
    $routes->post('/', 'UnitSatuanController::store');
    $routes->patch('/', 'UnitSatuanController::update');
    $routes->delete('/', 'UnitSatuanController::delete');
    $routes->get('(:num)', 'UnitSatuanController::show/$1');
    $routes->get('all', 'UnitSatuanController::all');
});
$routes->group('barangjasa', function(RouteCollection $routes){
    $routes->get('/', 'BarangJasaController::index');
    $routes->post('/', 'BarangJasaController::store');
    $routes->patch('/', 'BarangJasaController::update');
    $routes->delete('/', 'BarangJasaController::delete');
    $routes->get('(:num)', 'BarangJasaController::show/$1');
    $routes->get('all', 'BarangJasaController::all');
});
$routes->group('barangjasapemeriksaan', function(RouteCollection $routes){
    $routes->get('/', 'BarangjasaPemeriksaanController::index');
    $routes->post('/', 'BarangjasaPemeriksaanController::store');
    $routes->patch('/', 'BarangjasaPemeriksaanController::update');
    $routes->delete('/', 'BarangjasaPemeriksaanController::delete');
    $routes->get('(:num)', 'BarangjasaPemeriksaanController::show/$1');
    $routes->get('all', 'BarangjasaPemeriksaanController::all');
});
$routes->group('pembayaran', function(RouteCollection $routes){
    $routes->get('/', 'PembayaranController::index');
    $routes->post('/', 'PembayaranController::store');
    $routes->patch('/', 'PembayaranController::update');
    $routes->delete('/', 'PembayaranController::delete');
    $routes->get('(:num)', 'PembayaranController::show/$1');
    $routes->get('all', 'PembayaranController::all');
});





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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}