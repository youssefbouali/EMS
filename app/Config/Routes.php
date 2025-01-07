<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users/register', 'RegisterController::index');
$routes->post('/users/register', 'RegisterController::register');
$routes->get('/users/login', 'RegisterController::register');
$routes->get('users/login', 'LoginController::login');
$routes->post('/users/login', 'LoginController::login');
$routes->get('/users/logout', 'LoginController::logout');

