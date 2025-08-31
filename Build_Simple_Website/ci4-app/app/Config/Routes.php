<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/hello', 'Hello::index');
$routes->get('/hello/tabel', 'Hello::tabel');
$routes->get('/hello/tabelLoop', 'Hello::tabelLoop');
