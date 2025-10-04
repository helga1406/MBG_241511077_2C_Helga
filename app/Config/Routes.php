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

});

$routes->group('gudang', ['filter' => 'gudangfilter'], function($routes) {
    $routes->get('dashboard', 'Gudang::dashboard');

    // Bahan
    $routes->get('bahan/create', 'Gudang::bahanCreate');
    $routes->post('bahan/store', 'Gudang::bahanStore');
});
