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


$routes->get('/sectors', 'SectorController::sectors');

$routes->get('/modules/(:num)', 'ModuleController::modules/$1');

$routes->get('/module/(:num)', 'UserModuleController::getUsersByModule/$1');

$routes->get('/notes/(:num)', 'NoteController::notes/$1');
$routes->post('/notes/(:num)', 'NoteController::AddNotes/$1');


$routes->get('/notes/saisirNote', 'NoteController::index'); // Soumettre la note
$routes->post('/notes/saisirNote', 'NoteController::saisirNote'); // Soumettre la note