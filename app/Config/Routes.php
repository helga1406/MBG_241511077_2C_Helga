<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// app/Config/Routes.php

$routes->get('/login', 'Auth::login');  
$routes->post('/auth/processLogin', 'Auth::processLogin');  
$routes->get('/logout', 'Auth::logout');

// setelah login, redirect sesuai role
$routes->get('/gudang/dashboard', 'Gudang::dashboard');
$routes->get('/dapur/dashboard', 'Dapur::dashboard');




