<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'LoginController::create');

// $routes->get('/admin', 'AdminController::index');
$routes->get('/admin', 'AdminController::dashboard');
$routes->get('/admin/getEvents', 'AdminController::getEvents');


$routes->get('/customer', 'Customer::create');
$routes->get('/customer/view', 'Customer::view');


$routes->get('/product', 'ProductController::create');
$routes->get('/product/view', 'ProductController::view');


$routes->get('/category', 'CategoryController::create');
$routes->post('category/insert', 'CategoryController::insert');
$routes->get('/category/fetch', 'CategoryController::fetchAll');
$routes->get('/category/fetchCategory/(:num)', 'CategoryController::fetchCategory/$1');
$routes->post('/category/update', 'CategoryController::update');
$routes->post('/category/delete/(:num)', 'CategoryController::delete/$1');


$routes->get('/order', 'OrderController::create');
$routes->get('/order/view', 'OrderController::view');

// $routes->get('/login', 'LoginController::view');
// $routes->post('/login', 'LoginController::login');
// $routes->get('/logout', 'LoginController::logout');
// $routes->post('/register', 'LoginController::register');
    
$routes->get('login', 'LoginController::view');
$routes->post('login/authenticate', 'LoginController::login');
$routes->get('logout', 'LoginController::logout');
