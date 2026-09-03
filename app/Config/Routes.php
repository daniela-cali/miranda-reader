<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('register', '\App\Controllers\Auth\RegisterController::registerView');
$routes->post('register', '\App\Controllers\Auth\RegisterController::registerAction');
//$routes->get('/', 'ArchiveController::index');
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
