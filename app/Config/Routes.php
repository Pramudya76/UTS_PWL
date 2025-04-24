<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('produk', 'Home::produk', ['filter' => 'auth']);
$routes->get('keranjang', 'Home::keranjang', ['filter' => 'auth']);
$routes->get('stokBarang', 'Home::stokBarang', ['filter' => 'auth']);
$routes->get('pelanggan', 'Home::pelanggan', ['filter' => 'auth']);
$routes->get('kelolaBarang', 'Home::kelolaBarang', ['filter' => 'auth']);
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);
$routes->get('riwayatBelanja', 'Home::riwayatBelanja', ['filter' => 'auth']);

