<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('setup', 'Auth::setup');
$routes->post('setup', 'Auth::createAccount');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::authenticate');
$routes->post('logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], static function ($routes): void {
    $routes->get('/', 'Home::index');
    $routes->get('tasks', 'Tasks::index');
    $routes->get('tasks/new', 'Tasks::newTask');
    $routes->post('tasks/create', 'Tasks::create');
    $routes->get('tasks/(:num)/edit', 'Tasks::edit/$1');
    $routes->post('tasks/(:num)/update', 'Tasks::update/$1');
    $routes->post('tasks/(:num)/delete', 'Tasks::delete/$1');
    $routes->post('tasks/(:num)/toggle', 'Tasks::toggle/$1');
    $routes->get('profile', 'Profile::index');
    $routes->get('about', 'About::index');
});
