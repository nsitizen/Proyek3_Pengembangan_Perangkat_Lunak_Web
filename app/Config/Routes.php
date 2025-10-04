<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', 'AuthController::index');
$routes->post('/login/attempt', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

/* $routes->group('/', ['filter' => 'auth'], function($routes) {
    $routes->get('/home', 'Home::index');
}); */
