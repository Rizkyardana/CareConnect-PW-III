<?php

use CodeIgniter\Router\RouteCollection;

// Auth Routes
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginPost');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// User Routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Dashboard User
    $routes->get('dashboard', 'UserController::dashboard');
    $routes->get('profile', 'UserController::profile');
    
    // Report Routes
    $routes->get('reports', 'ReportController::index');
    $routes->get('reports/create', 'ReportController::create');
    $routes->post('reports', 'ReportController::store');
    $routes->get('reports/(:num)', 'ReportController::show/$1');
});

// Admin Routes
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'AdminController::index');
    
    // Reports Management
    $routes->get('reports', 'AdminController::reports');
    $routes->get('reports/(:num)', 'AdminController::showReport/$1');
    $routes->put('reports/(:num)', 'AdminController::updateReport/$1');
    $routes->post('reports/(:num)/notes', 'AdminController::addNote/$1');
    $routes->delete('reports/(:num)/delete', 'AdminController::deleteReport/$1');
});

// Profile Routes
$routes->group('profile', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'UserController::profile');
    $routes->get('edit', 'UserController::editProfile');
    $routes->put('update', 'UserController::updateProfile'); // Gunakan put untuk update
    $routes->post('change-password', 'UserController::changePassword');
});

/**
 * @var RouteCollection $routes
 */
