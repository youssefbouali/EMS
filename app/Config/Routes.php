<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');  // Définir la route vers la page d'accueil
$routes->get('/register', 'RegisterController::RegisterForm');
$routes->post('/register', 'RegisterController::register');
$routes->get('/login', 'LoginController::LoginForm');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/notes', 'NotesController::index'); // Afficher les notes et le formulaire
$routes->post('/notes/saisirNote', 'NotesController::saisirNote'); // Soumettre la note
$routes->get('/notes/modifier/(:num)', 'NotesController::modifier/$1'); // Modifier la note
$routes->get('/notes/supprimer/(:num)', 'NotesController::supprimer/$1'); // Supprimer la note
$routes->post('/notes/modifierNote/(:num)', 'NotesController::modifierNote/$1'); // Traiter la modification
