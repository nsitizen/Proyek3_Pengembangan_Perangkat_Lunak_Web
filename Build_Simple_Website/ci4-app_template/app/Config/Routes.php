<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::index');
$routes->post('/login/attempt', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->group('/', ['filter' => 'auth'], function($routes) {
    
    // Rute untuk halaman Home
    $routes->get('', 'Pages::index'); // '' berarti halaman utama (root)

    // Rute untuk menampilkan semua mahasiswa
    $routes->get('mahasiswa', 'Mahasiswa::index');

    // Rute untuk semua fitur CRUD mahasiswa
    $routes->get('mahasiswa/create', 'Mahasiswa::create');
    $routes->post('mahasiswa/save', 'Mahasiswa::save');
    $routes->get('mahasiswa/detail/(:segment)', 'Mahasiswa::detail/$1');
    $routes->get('mahasiswa/edit/(:segment)', 'Mahasiswa::edit/$1');
    $routes->post('/mahasiswa/update', 'Mahasiswa::update');
    $routes->post('mahasiswa/delete/(:segment)', 'Mahasiswa::delete/$1');
});