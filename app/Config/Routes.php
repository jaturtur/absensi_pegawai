<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // login gsn logout 
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');

// bagian admin 
$routes->get('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan', 'Admin\Jabatan::index', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/create', 'Admin\Jabatan::create', ['filter' => 'adminFilter']);
$routes->post('admin/jabatan/store', 'Admin\Jabatan::store', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/edit/(:segment)', 'Admin\Jabatan::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/jabatan/update/(:segment)', 'Admin\Jabatan::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/delete/(:segment)', 'Admin\Jabatan::delete/$1', ['filter' => 'adminFilter']);


$routes->get('admin/lokasi_presensi', 'Admin\LokasiPresensi::index', ['filter' => 'adminFilter']);
$routes->get('admin/lokasi_presensi/create', 'Admin\LokasiPresensi::create', ['filter' => 'adminFilter']);
$routes->post('admin/lokasi_presensi/store', 'Admin\LokasiPresensi::store', ['filter' => 'adminFilter']);
$routes->get('admin/lokasi_presensi/edit/(:segment)', 'Admin\LokasiPresensi::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/lokasi_presensi/update/(:segment)', 'Admin\LokasiPresensi::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/lokasi_presensi/delete/(:segment)', 'Admin\LokasiPresensi::delete/$1', ['filter' => 'adminFilter']);
$routes->get('admin/lokasi_presensi/detail/(:segment)', 'Admin\LokasiPresensi::detail/$1', ['filter' => 'adminFilter']);

$routes->get('admin/data_pegawai', 'Admin\DataPegawai::index', ['filter' => 'adminFilter']);
$routes->get('admin/data_pegawai/create', 'Admin\DataPegawai::create', ['filter' => 'adminFilter']);
$routes->post('admin/data_pegawai/store', 'Admin\DataPegawai::store', ['filter' => 'adminFilter']);
$routes->get('admin/data_pegawai/edit/(:segment)', 'Admin\DataPegawai::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/data_pegawai/update/(:segment)', 'Admin\DataPegawai::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/data_pegawai/delete/(:segment)', 'Admin\DataPegawai::delete/$1', ['filter' => 'adminFilter']);
$routes->get('admin/data_pegawai/detail/(:segment)', 'Admin\DataPegawai::detail/$1', ['filter' => 'adminFilter']);

$routes->get('admin/rekap_harian', 'Admin\RekapPresensi::rekap_harian', ['filter' => 'adminFilter']);
$routes->get('admin/rekap_bulanan', 'Admin\RekapPresensi::rekap_bulanan', ['filter' => 'adminFilter']);
$routes->get('admin/ketidakhadiran', 'Admin\Ketidakhadiran::index', ['filter' => 'adminFilter']);
$routes->get('admin/setuju_ketidakhadiran/(:segment)', 'Admin\Ketidakhadiran::setuju/$1', ['filter' => 'adminFilter']);
$routes->get('admin/tolak_ketidakhadiran/(:segment)', 'Admin\Ketidakhadiran::tolak/$1', ['filter' => 'adminFilter']);
$routes->get('admin/delete_ketidakhadiran/delete/(:segment)', 'Admin\Ketidakhadiran::delete/$1', ['filter' => 'adminFilter']);


//bagian pegawai 
$routes->get('pegawai/home', 'Pegawai\Home::index', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/presensi_masuk', 'Pegawai\Home::presensi_masuk', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/presensi_masuk_aksi', 'Pegawai\Home::presensi_masuk_aksi', ['filter' => 'pegawaiFilter']);

$routes->post('pegawai/presensi_keluar/(:segment)', 'Pegawai\Home::presensi_keluar/$1', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/presensi_keluar_aksi/(:segment)', 'Pegawai\Home::presensi_keluar_aksi/$1', ['filter' => 'pegawaiFilter']);

$routes->get('pegawai/rekap_presensi', 'Pegawai\RekapPresensi::index', ['filter' => 'pegawaiFilter']);

$routes->get('pegawai/logbook', 'Pegawai\Logbook::index', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/logbook/create', 'Pegawai\Logbook::create', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/logbook/store', 'Pegawai\Logbook::store', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/logbook/edit/(:num)', 'Pegawai\Logbook::edit/$1', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/logbook/update/(:num)', 'Pegawai\Logbook::update/$1', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/logbook/delete/(:num)', 'Pegawai\Logbook::delete/$1', ['filter' => 'pegawaiFilter']);
$routes->get('/pegawai/logbook/detail/(:num)', 'Pegawai\Logbook::detail/$1', ['filter' => 'pegawaiFilter']);


$routes->get('pegawai/ketidakhadiran', 'Pegawai\Ketidakhadiran::index', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/ketidakhadiran/create', 'pegawai\Ketidakhadiran::create', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/ketidakhadiran/store', 'pegawai\Ketidakhadiran::store', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/ketidakhadiran/edit/(:segment)', 'pegawai\Ketidakhadiran::edit/$1', ['filter' => 'pegawaiFilter']);
$routes->post('pegawai/ketidakhadiran/update/(:segment)', 'pegawai\Ketidakhadiran::update/$1', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/ketidakhadiran/delete/(:segment)', 'pegawai\Ketidakhadiran::delete/$1', ['filter' => 'pegawaiFilter']);
$routes->get('pegawai/ketidakhadiran/detail/(:segment)', 'pegawai\Ketidakhadiran::detail/$1', ['filter' => 'pegawaiFilter']);



