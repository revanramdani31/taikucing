<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');

// Auth Routes (tanpa protection) 
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// Dashboard Routes (dengan AuthFilter protection)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/gudang/dashboard', 'GudangController::index');
    $routes->get('/dapur/dashboard', 'DapurController::index');
});