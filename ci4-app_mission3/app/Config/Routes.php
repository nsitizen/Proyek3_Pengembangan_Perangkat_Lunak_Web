<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute untuk proses login dan logout (bisa diakses publik)
$routes->get('/login', 'AuthController::index');
$routes->post('/login/attempt', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->get('courses/enroll/(:num)', 'Courses::enroll/$1');
// Grup utama untuk semua halaman yang membutuhkan login.
// Dilindungi oleh filter 'auth'.
$routes->group('/', ['filter' => 'auth'], function($routes) {
    
    // Rute untuk halaman Home (bisa diakses semua role yang sudah login)
    $routes->get('', 'Pages::index');

    // ==========================================================
    // GRUP UNTUK RUTE KHUSUS ADMIN
    // Dilindungi oleh filter 'admin' tambahan.
    // ==========================================================
    $routes->group('', ['filter' => 'admin'], function($routes) {
        
        // --- Rute CRUD Mahasiswa (Secara Manual) ---
        $routes->get('mahasiswa', 'Mahasiswa::index'); // Menampilkan semua
        $routes->get('mahasiswa/new', 'Mahasiswa::new'); // Form tambah
        $routes->post('mahasiswa/create', 'Mahasiswa::create'); // Proses simpan
        $routes->get('mahasiswa/(:num)', 'Mahasiswa::show/$1'); // Detail
        $routes->get('mahasiswa/edit/(:num)', 'Mahasiswa::edit/$1'); // Form edit
        $routes->put('mahasiswa/update/(:num)', 'Mahasiswa::update/$1'); // Proses update
        $routes->delete('mahasiswa/delete/(:num)', 'Mahasiswa::delete/$1'); // Proses hapus

        // --- Rute CRUD Mata Kuliah (Manual) ---
        $routes->get('courses', 'Courses::index');                   // Halaman utama
        $routes->get('courses/new', 'Courses::new');                 // Form tambah
        $routes->post('courses/create', 'Courses::create');              // Proses simpan data baru
        $routes->get('courses/edit/(:num)', 'Courses::edit/$1');      // Form edit
        $routes->put('courses/update/(:num)', 'Courses::update/$1');    // Proses update
        $routes->delete('courses/delete/(:num)', 'Courses::delete/$1'); // Proses hapus
        $routes->get('courses/(:num)', 'Courses::show/$1');  
    });

    // ==========================================================
    // GRUP UNTUK RUTE KHUSUS MAHASISWA
    // (Tidak perlu filter tambahan, cukup filter 'auth' dari grup utama)
    // ==========================================================
    $routes->get('my-courses', 'Courses::myCourses');
    $routes->get('take-courses', 'Courses::takeCourses');

});