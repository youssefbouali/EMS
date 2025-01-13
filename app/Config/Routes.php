<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/register', 'RegisterController::RegisterForm');
$routes->post('/register', 'RegisterController::register');

$routes->get('/login', 'LoginController::LoginForm');
$routes->post('/login', 'LoginController::login');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/notes', 'NoteController::NoteForm');
$routes->post('/notes', 'NoteController::AddNote');

$routes->get('/filiere/ingenierie', 'SaisieController::ingenierie');
$routes->get('/filiere/intelligence', 'SaisieController::intelligence');
$routes->get('/filiere/systeme', 'SaisieController::systeme');

