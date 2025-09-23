<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute untuk proses login dan logout (bisa diakses publik)
$routes->get('/login', 'AuthController::index');
$routes->post('/login/attempt', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

// RUTE UNTUK REST API
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('courses', 'CoursesApi::index');
});

// Grup utama untuk semua halaman yang membutuhkan login.
// Dilindungi oleh filter 'auth'.
$routes->group('/', ['filter' => 'auth'], function($routes) {
    
    // Rute untuk halaman Home
    $routes->get('', 'Pages::index');

    // ==========================================================
    // GRUP UNTUK RUTE KHUSUS ADMIN
    // ==========================================================
    $routes->group('', ['filter' => 'admin'], function($routes) {
        
        // --- Rute CRUD Mahasiswa ---
        $routes->get('mahasiswa', 'Mahasiswa::index');
        $routes->get('mahasiswa/new', 'Mahasiswa::new');
        $routes->post('mahasiswa/create', 'Mahasiswa::create');
        $routes->get('mahasiswa/(:num)', 'Mahasiswa::show/$1');
        $routes->get('mahasiswa/edit/(:num)', 'Mahasiswa::edit/$1');
        $routes->put('mahasiswa/update/(:num)', 'Mahasiswa::update/$1');
        $routes->delete('mahasiswa/delete/(:num)', 'Mahasiswa::delete/$1');

        // --- Rute CRUD Mata Kuliah ---
        $routes->get('courses', 'Courses::index');
        $routes->get('courses/new', 'Courses::new');
        $routes->post('courses/create', 'Courses::create');
        $routes->get('courses/edit/(:num)', 'Courses::edit/$1');
        $routes->put('courses/update/(:num)', 'Courses::update/$1');
        $routes->delete('courses/delete/(:num)', 'Courses::delete/$1');
        $routes->get('courses/(:num)', 'Courses::show/$1'); 
    });

    // ==========================================================
    // GRUP UNTUK RUTE KHUSUS MAHASISWA
    // ==========================================================
    $routes->get('my-courses', 'Courses::myCourses');
    $routes->get('take-courses', 'Courses::takeCourses');
    
    // Rute ini sudah BENAR untuk menerima data dari JavaScript
    $routes->post('courses/enroll', 'Courses::enrollStudent');
});