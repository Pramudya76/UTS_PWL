<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');

$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::register');

$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});
$routes->post('produk', 'ProdukController::create', ['filter' => 'auth']);

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->get('transaksi/selesaikan/(:num)', 'TransaksiController::selesaikan/$1', ['filter' => 'auth']);
$routes->get('transaksi/batalkan/(:num)', 'TransaksiController::batalkan/$1');

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->resource('api', ['controller' => 'apiController']);
$routes->get('pelanggan', 'Home::pelanggan', ['filter' => 'auth']);
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->get('dataTransaksi', 'Home::dataTransaksi', ['filter' => 'auth']);

$routes->get('usersProfile', 'UserController::profile', ['filter' => 'auth']);
$routes->post('usersProfile/update/(:num)', 'UserController::update/$1', ['filter' => 'auth']);

$routes->get('chart', 'TransaksiController::chart');

