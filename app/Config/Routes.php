<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// $routes->get('produk', 'Home::produk', ['filter' => 'auth']);
// $routes->post('produk', 'ProdukController::create', ['filter' => 'auth']);
// $routes->post('produk/edit/(:any)', 'ProdukController::edit/$1', ['filter' => 'auth']);
// $routes->get('produk/delete/(:any)', 'ProdukController::delete/$1', ['filter' => 'auth']);

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
});
$routes->post('produk', 'ProdukController::create', ['filter' => 'auth']);

$routes->get('keranjang', 'Home::keranjang', ['filter' => 'auth']);
$routes->get('stokBarang', 'Home::stokBarang', ['filter' => 'auth']);
$routes->get('pelanggan', 'Home::pelanggan', ['filter' => 'auth']);
$routes->get('kelolaBarang', 'Home::kelolaBarang', ['filter' => 'auth']);
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);
$routes->get('riwayatBelanja', 'Home::riwayatBelanja', ['filter' => 'auth']);

