<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('admin', function ($routes) {
	$routes->get('/', 'Admin\Home::index');
	$routes->get('/product', 'Admin\Product::index');
	$routes->get('/article', 'Admin\Article::index');
	$routes->post('/product/store', 'Admin\Product::store');
	$routes->get('/product/edit/(:any)', 'Admin\Product::edit/$1');
	$routes->get('/product/modal/(:any)', 'Admin\Product::modal/$1');
	$routes->delete('/product/delete/(:any)', 'Admin\Product::modal/$1');
	$routes->post('/article/store', 'Admin\Article::store');
	$routes->get('/article/edit/(:any)', 'Admin\Article::edit/$1');
	$routes->get('/article/modal/(:any)', 'Admin\Article::modal/$1');
	$routes->delete('/article/delete/(:any)', 'Admin\Article::modal/$1');

	$routes->get('login', 'Admin\Login::index');
	$routes->post('login/post_login', 'Admin\Login::post_login');
	$routes->get('logout', 'Admin\Login::logout', ['as' => 'admin_logout']);
});

$routes->get('/', 'FrontEnd\Home::index');
$routes->get('/detail/(:any)', 'FrontEnd\Home::show/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
