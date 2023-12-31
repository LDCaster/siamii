<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/user-profile', 'AuthController::profile');
$routes->post('/update-profile', 'AuthController::updateProfile');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/unit', 'UnitController::index');
$routes->get('/unit/create', 'UnitController::create');
$routes->post('/unit/save', 'UnitController::save');
$routes->get('/unit/edit/(:num)', 'UnitController::edit/$1');
$routes->post('/unit/update/(:num)', 'UnitController::update/$1');
$routes->get('/unit/delete/(:num)', 'UnitController::delete/$1');

$routes->get('/user', 'UserController::index');
$routes->get('/user/create', 'UserController::create');
$routes->post('/user/save', 'UserController::save');
$routes->get('/user/edit/(:num)', 'UserController::edit/$1');
$routes->post('/user/update/(:num)', 'UserController::update/$1');
$routes->get('/user/delete/(:num)', 'UserController::delete/$1');

$routes->get('/siklus', 'SiklusController::index');
$routes->get('/siklus/create', 'SiklusController::create');
$routes->post('/siklus/save', 'SiklusController::save');
$routes->get('/siklus/edit/(:num)', 'SiklusController::edit/$1');
$routes->post('/siklus/update/(:num)', 'SiklusController::update/$1');
$routes->get('/siklus/delete/(:num)', 'SiklusController::delete/$1');

$routes->get('/standar', 'StandarController::index');
$routes->get('/standar/create', 'StandarController::create');
$routes->post('/standar/save', 'StandarController::save');
$routes->get('/standar/edit/(:num)', 'StandarController::edit/$1');
$routes->post('/standar/update/(:num)', 'StandarController::update/$1');
$routes->get('/standar/delete/(:num)', 'StandarController::delete/$1');


$routes->get('/sub-standar/(:num)', 'SubStandarController::index/$1');
$routes->get('/sub-standar/create/(:num)', 'SubStandarController::create/$1');
$routes->post('/sub-standar/save', 'SubStandarController::save');
$routes->get('/sub-standar/edit/(:num)', 'SubStandarController::edit/$1');
$routes->post('/sub-standar/update/(:num)', 'SubStandarController::update/$1');
$routes->get('/sub-standar/delete/(:num)', 'SubStandarController::delete/$1');

$routes->get('/butiran', 'ButiranController::index');
$routes->get('/butiran/create', 'ButiranController::create');
$routes->post('/butiran/save', 'ButiranController::save');
$routes->get('/butiran/edit/(:num)', 'ButiranController::edit/$1');
$routes->post('/butiran/update/(:num)', 'ButiranController::update/$1');
$routes->get('/butiran/delete/(:num)', 'ButiranController::delete/$1');
$routes->get('butiran/get-sub-standar/(:num)', 'ButiranController::getSubStandar/$1');

$routes->get('/proses-ami', 'ProsesAMIController::index');
$routes->get('/proses-ami/create', 'ProsesAMIController::create');
$routes->post('/proses-ami/save', 'ProsesAMIController::save');
$routes->get('/proses-ami/edit/(:num)', 'ProsesAMIController::edit/$1');
$routes->post('/proses-ami/update/(:num)', 'ProsesAMIController::update/$1');
$routes->get('/proses-ami/delete/(:num)', 'ProsesAMIController::delete/$1');
$routes->get('proses-ami/toggle-status/(:num)', 'ProsesAMIController::toggleStatus/$1');
$routes->get('proses-ami/export-spreadsheet/(:num)', 'ProsesAMIController::exportSpreadsheet/$1');

$routes->get('/proses-ami/hasil-ami/(:num)', 'HasilAMIController::index/$1');

$routes->get('/hasil-ami/create/(:num)', 'HasilAMIController::create/$1');
$routes->post('/hasil-ami/save', 'HasilAMIController::save');
$routes->get('/get-butiran-mutu/(:num)', 'HasilAMIController::getButiranMutu/$1');
$routes->get('hasil-ami/delete/(:num)', 'HasilAMIController::delete/$1');

$routes->get('/evaluasi-diri', 'AuditeeController::index');
$routes->get('hasil-ami/detail/(:num)', 'AuditeeController::detail/$1');
$routes->get('hasil-ami/evaluasi-diri/(:num)', 'AuditeeController::viewEvaluasiDiri/$1');
$routes->post('hasil-ami/update-evaluasi-diri/(:num)', 'AuditeeController::updateEvaluasiDiri/$1');

$routes->get('/evaluasi-audit', 'AuditorController::index');
$routes->get('hasil-ami/detail-audit/(:num)', 'AuditorController::detailAudit/$1');
$routes->get('hasil-ami/audit/(:num)', 'AuditorController::viewAudit/$1');
$routes->post('hasil-ami/update-audit/(:num)', 'AuditorController::updateAudit/$1');

$routes->get('/pengendalian', 'PengendalianController::index');
$routes->get('hasil-ami/pengendalian/(:num)', 'PengendalianController::viewPengendalian/$1');
$routes->post('hasil-ami/update-pengendalian/(:num)', 'PengendalianController::updatePengendalian/$1');
$routes->get('hasil-ami/detail-pengendalian/(:num)', 'PengendalianController::detailPengendalian/$1');

$routes->get('/peningkatan', 'PeningkatanController::index');
$routes->get('hasil-ami/detail-peningkatan/(:num)', 'PeningkatanController::detailPeningkatan/$1');
$routes->get('hasil-ami/peningkatan/(:num)', 'PeningkatanController::viewPeningkatan/$1');
$routes->post('hasil-ami/update-peningkatan/(:num)', 'PeningkatanController::updatePeningkatan/$1');
