<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default: arahkan ke login
$routes->get('/', 'Auth::login');

$routes->get('/login', 'Auth::login');  
$routes->post('/auth/processLogin', 'Auth::processLogin');  
$routes->get('/logout', 'Auth::logout');

$routes->group('dapur', ['filter' => 'dapurfilter'], function($routes) {
    $routes->get('dashboard', 'Dapur::dashboard');
    $routes->get('permintaan', 'Dapur::permintaanIndex');
    $routes->get('permintaan/create', 'Dapur::permintaanCreate');
    $routes->post('permintaan/store', 'Dapur::permintaanStore');
});

$routes->group('gudang', ['filter' => 'gudangfilter'], function($routes) {
    $routes->get('dashboard', 'Gudang::dashboard');

    // Bahan
    $routes->get('bahan', 'Gudang::bahanIndex');
    $routes->get('bahan/create', 'Gudang::bahanCreate');
    $routes->post('bahan/store', 'Gudang::bahanStore');
    $routes->get('bahan/edit/(:num)', 'Gudang::bahanEdit/$1');
    $routes->post('bahan/update/(:num)', 'Gudang::bahanUpdate/$1');
    $routes->get('bahan/delete/(:num)', 'Gudang::bahanDeleteConfirm/$1');
    $routes->post('bahan/delete/(:num)', 'Gudang::bahanDelete/$1');

    // Permintaan
    $routes->get('permintaan', 'Gudang::permintaanIndex');
});
