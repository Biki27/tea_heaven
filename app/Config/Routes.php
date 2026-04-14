<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// default route settings
$routes->get('/', 'Home::index');
$routes->get('shop', 'Shop::index');
$routes->get('cart', 'Cart::index');
$routes->post('cart/add', 'Cart::add');
$routes->get('cart/remove/(:any)', 'Cart::remove/$1');

// Auth routes
$routes->get('login', 'Auth::index');
$routes->post('auth/register', 'Auth::register');
$routes->post('auth/login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// PROTECTED ROUTES (Directly applying the filter)
$routes->get('checkout', 'Checkout::index', ['filter' => 'authGuard']);
$routes->post('checkout/process', 'Checkout::process', ['filter' => 'authGuard']);
$routes->get('checkout/success', 'Checkout::success', ['filter' => 'authGuard']);