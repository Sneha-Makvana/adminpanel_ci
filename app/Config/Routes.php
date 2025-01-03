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
$routes->post('customer/insert', 'Customer::insert');
$routes->get('/customer/fetch', 'Customer::fetchAll');
$routes->delete('/customer/delete/(:num)', 'Customer::delete/$1');
$routes->post('/customer/update', 'Customer::update');
$routes->get('/customer/fetchCustomer/(:num)', 'Customer::fetchCustomer/$1');
$routes->get('/customer/profile', 'Customer::display');
$routes->get('customer/details/(:num)', 'Customer::details/$1');


$routes->get('/product', 'ProductController::create');
$routes->get('/product/view', 'ProductController::view');
$routes->post('product/insert', 'ProductController::insert');
$routes->get('/product/fetchProduct/(:num)', 'ProductController::fetchProduct/$1');
$routes->get('/product/fetch', 'ProductController::fetchAll');
$routes->post('/product/update', 'ProductController::update');
$routes->delete('/product/delete/(:num)', 'ProductController::delete/$1');
$routes->get('/product/profile', 'ProductController::display');
$routes->get('product/details/(:num)', 'ProductController::details/$1');
$routes->post('product/deleteImage/(:num)', 'ProductController::deleteImage/$1');


$routes->get('/category', 'CategoryController::create');
$routes->post('category/insert', 'CategoryController::insert');
$routes->get('/category/fetch', 'CategoryController::fetchAll');
$routes->get('/category/fetchCategory/(:num)', 'CategoryController::fetchCategory/$1');
$routes->post('/category/update', 'CategoryController::update');
$routes->post('/category/delete/(:num)', 'CategoryController::delete/$1');


$routes->get('/order', 'OrderController::create');
$routes->get('/order/view', 'OrderController::view');
$routes->post('order/submitBooking', 'OrderController::submitBooking');
$routes->post('/order/deleteBooking/(:num)', 'OrderController::deleteBooking/$1');
$routes->get('/order/profile', 'OrderController::display');
$routes->get('order/fetchOrderDetails/(:num)', 'OrderController::fetchOrderDetails/$1');
$routes->get('order/display/(:num)', 'OrderController::display/$1');
$routes->get('order/fetchOrders', 'OrderController::fetchOrders');


$routes->get('/login', 'LoginController::create');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');

// $routes->post('/register', 'LoginController::register');
    
// $routes->get('login', 'LoginController::view');
// // $routes->post('login/authenticate', 'LoginController::login');
// // $routes->get('logout', 'LoginController::logout');

// $routes->post('login', 'LoginController::login');
// $routes->post('logout', 'LoginController::logout');
