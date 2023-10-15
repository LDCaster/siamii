<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/unit', 'UnitController::index');
$routes->get('/unit/create', 'UnitController::create');
$routes->post('/unit/save', 'UnitController::save');
$routes->get('/unit/edit/(:num)', 'UnitController::edit/$1');
$routes->post('/unit/update/(:num)', 'UnitController::update/$1');
$routes->get('/unit/delete/(:num)', 'UnitController::delete/$1');
