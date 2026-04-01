<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
use Buki\Router\Router;

Session::start();

$router = new Router();

// Routes publiques
$router->get('/', 'App\Controllers\TripController@index');
$router->get('/login', 'App\Controllers\AuthController@showLogin');
$router->post('/login', 'App\Controllers\AuthController@login');
$router->get('/logout', 'App\Controllers\AuthController@logout');

// Routes utilisateur connecté
$router->get('/trips/create', 'App\Controllers\TripController@create');
$router->post('/trips/create', 'App\Controllers\TripController@store');
$router->get('/trips/edit/(\d+)', 'App\Controllers\TripController@edit');
$router->post('/trips/edit/(\d+)', 'App\Controllers\TripController@update');
$router->post('/trips/delete/(\d+)', 'App\Controllers\TripController@destroy');

// Routes admin
$router->get('/admin', 'App\Controllers\AdminController@dashboard');
$router->get('/admin/users', 'App\Controllers\AdminController@users');
$router->get('/admin/agencies', 'App\Controllers\AdminController@agencies');
$router->get('/admin/agencies/create', 'App\Controllers\AdminController@createAgency');
$router->post('/admin/agencies/create', 'App\Controllers\AdminController@storeAgency');
$router->get('/admin/agencies/edit/(\d+)', 'App\Controllers\AdminController@editAgency');
$router->post('/admin/agencies/edit/(\d+)', 'App\Controllers\AdminController@updateAgency');
$router->post('/admin/agencies/delete/(\d+)', 'App\Controllers\AdminController@destroyAgency');
$router->get('/admin/trips', 'App\Controllers\AdminController@trips');
$router->post('/admin/trips/delete/(\d+)', 'App\Controllers\AdminController@destroyTrip');

$router->run();