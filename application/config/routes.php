<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';

// Admin routes
$route['admin'] = 'admin/index';
$route['admin/pasien'] = 'admin/pasien';
$route['admin/pasien/tambah'] = 'admin/tambah_pasien';
$route['admin/pasien/edit/(:num)'] = 'admin/edit_pasien/$1';
$route['admin/pasien/hapus/(:num)'] = 'admin/hapus_pasien/$1';
$route['admin/pendaftaran'] = 'admin/pendaftaran';
$route['admin/pendaftaran/detail/(:num)'] = 'admin/detail_pendaftaran/$1';
$route['admin/pendaftaran/setujui/(:num)'] = 'admin/setujui/$1';
$route['admin/pendaftaran/tolak/(:num)'] = 'admin/tolak/$1';
$route['admin/jadwal'] = 'admin/jadwal';
$route['admin/laporan'] = 'admin/laporan';
$route['admin/laporan/csv'] = 'admin/export_csv';
$route['admin/laporan/pdf'] = 'admin/export_pdf';

// Pasien routes
$route['pasien'] = 'pasien_controller/index';
$route['pasien/daftar'] = 'pasien_controller/daftar';
$route['pasien/status'] = 'pasien_controller/status';
$route['pasien/detail/(:num)'] = 'pasien_controller/detail/$1';
