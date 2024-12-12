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
$routes->post('/customer/delete/(:num)', 'Customer::delete/$1');
$routes->post('/customer/update', 'Customer::update');
$routes->get('/customer/fetchCustomer/(:num)', 'Customer::fetchCustomer/$1');
$routes->get('/customer/profile', 'Customer::display');
$routes->get('customer/details/(:num)', 'Customer::details/$1');



$routes->get('/event', 'EventController::create');
$routes->get('/event/view', 'EventController::view');
$routes->post('event/insert', 'EventController::insert');
$routes->get('/event/fetchEvent/(:num)', 'EventController::fetchEvent/$1');
$routes->get('/event/fetch', 'EventController::fetchAll');
$routes->post('/event/update', 'EventController::update');
$routes->post('/event/delete/(:num)', 'EventController::delete/$1');
$routes->get('/event/profile', 'EventController::display');
$routes->get('event/details/(:num)', 'EventController::details/$1');
$routes->post('event/deleteImage/(:num)', 'EventController::deleteImage/$1');


$routes->get('/category', 'CategoryController::create');
$routes->post('category/insert', 'CategoryController::insert');
$routes->get('/category/fetch', 'CategoryController::fetchAll');
$routes->get('/category/fetchCategory/(:num)', 'CategoryController::fetchCategory/$1');
$routes->post('/category/update', 'CategoryController::update');
$routes->post('/category/delete/(:num)', 'CategoryController::delete/$1');


$routes->get('/booking', 'BookingController::create');
$routes->get('/booking/view', 'BookingController::view');
$routes->post('booking/submitBooking', 'BookingController::submitBooking');
$routes->post('/booking/deleteBooking/(:num)', 'BookingController::deleteBooking/$1');
$routes->get('/booking/profile', 'BookingController::display');
$routes->get('booking/fetchBookingDetails/(:num)', 'BookingController::fetchBookingDetails/$1');
$routes->get('booking/display/(:num)', 'BookingController::display/$1');


$routes->get('/login', 'LoginController::create');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/register', 'LoginController::register');

