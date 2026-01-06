<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/siswa/create', 'SiswaController::create');
$routes->post('/siswa/store', 'SiswaController::store');
$routes->post('/siswa/upload/(:num)', 'SiswaController::uploadBerkas/$1');

$routes->get('/user/create', 'UsersController::store');
    