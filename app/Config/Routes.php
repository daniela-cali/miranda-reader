<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

service('auth')->routes($routes);


//$routes->get('/', 'ArchiveController::index');
$routes->get('/', 'HomeController::index', ['as'=> 'dashboard']);

$routes->group('admin', ['filter' => 'group:superadmin,admin'], function($routes) {
    /*
     * Importazione Clienti 
    $routes->get('importClienti', 'Admin\ImportClientiController::index');
    $routes->post('importClienti', 'Admin\ImportClientiController::importClienti');
    */

    /**
     * Impostazioni sito 
     */
    // $routes->get('settings', 'Admin\SettingsController::index');
    // $routes->post('settings/save', 'Admin\SettingsController::save');

    /**
     * Gestione utenti — rotte per CRUD completo su utenti, con approvazione e eliminazione.
     * Il filter 'group:superadmin,admin' assicura che solo gli amministratori possano accedere a queste rotte.
     */
    $routes->get('users',                   'Admin\UsersController::index',         ['as' => 'users_index']);
    $routes->get('users/(:num)',            'Admin\UsersController::show/$1',       ['as' => 'users_show']);
    $routes->get('users/create',            'Admin\UsersController::create',        ['as' => 'users_create']);
    $routes->post('users',                  'Admin\UsersController::store',         ['as' => 'users_store']);
    $routes->get('users/edit/(:num)',       'Admin\UsersController::edit/$1',       ['as' => 'users_edit']);
    $routes->put('users/update/(:num)',     'Admin\UsersController::update/$1',     ['as' => 'users_update']);
    $routes->get('users/delete/(:num)',     'Admin\UsersController::delete/$1',     ['as' => 'users_delete']);

});



