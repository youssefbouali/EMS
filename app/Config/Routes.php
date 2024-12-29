<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users/register', 'Register::register');
$routes->get('/users/login', 'Login::login');

