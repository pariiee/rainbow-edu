<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'SiswaController::index');

/* ========================
   SISWA CRUD
======================== */

$routes->get('/siswa', 'SiswaController::index');          
$routes->get('/siswa/create', 'SiswaController::create');  
$routes->post('/siswa', 'SiswaController::store');         

// 🔴 YANG SPESIFIK DULU
$routes->get('/siswa/(:num)/edit', 'SiswaController::edit/$1');
$routes->post('/siswa/(:num)/delete', 'SiswaController::delete/$1');
$routes->post('/siswa/(:num)/berkas', 'SiswaController::uploadBerkas/$1');
$routes->post('/siswa/(:num)', 'SiswaController::update/$1');

// 🔵 PALING UMUM TARUH TERAKHIR
$routes->get('/siswa/(:num)', 'SiswaController::show/$1');

/* ========================
   USER
======================== */

$routes->get('/user/create', 'UsersController::create');
$routes->post('/user', 'UsersController::store');
