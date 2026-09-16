<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

service('auth')->routes($routes);


//$routes->get('/', 'ArchiveController::index');
$routes->get('/', 'HomeController::index', ['as'=> 'dashboard']);

$routes->group('admin', ['filter' => 'group:superadmin,admin'], function($routes) {

$routes->get('users',                   'Admin\UsersController::index',         ['as' => 'users_index']);
    $routes->get('users/(:num)',            'Admin\UsersController::show/$1',       ['as' => 'users_show']);
    $routes->get('users/create',            'Admin\UsersController::create',        ['as' => 'users_create']);
    $routes->post('users',                  'Admin\UsersController::store',         ['as' => 'users_store']);
    $routes->get('users/edit/(:num)',       'Admin\UsersController::edit/$1',       ['as' => 'users_edit']);
    $routes->put('users/update/(:num)',     'Admin\UsersController::update/$1',     ['as' => 'users_update']);   
    $routes->delete('users/delete/(:num)',     'Admin\UsersController::delete/$1',     ['as' => 'users_delete', 'filter' => 'group:superadmin']);
    });

$routes->group('chat', function($routes) {
    $routes->get('index',  'ChatViewerController::index', ['as' => 'chat_index']);
    $routes->get('conversation',  'ChatViewerController::conversation', ['as' => 'chat_conversation']);
});



