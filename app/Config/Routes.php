<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Beranda::index');

// ADMIN

// KERAJAAN
$routes->get('/kerajaanadmin/create', 'KerajaanAdmin::create');
$routes->get('/kerajaanadmin/edit/(:segment)', 'KerajaanAdmin::edit/$1');
$routes->delete('/kerajaanadmin/(:num)', 'KerajaanAdmin::delete/$1');
$routes->get('/kerajaanadmin/(:any)', 'KerajaanAdmin::detail/$1');

// TOKOH KERAJAAN
$routes->get('/tokohadmin/create', 'TokohAdmin::create');
$routes->get('/tokohadmin/edit/(:segment)', 'TokohAdmin::edit/$1');
$routes->delete('/tokohadmin/(:num)', 'TokohAdmin::delete/$1');
$routes->get('tokohadmin/(:any)', 'TokohAdmin::detail/$1');

// GALERI
$routes->get('/galeriadmin/create', 'GaleriAdmin::create');
$routes->get('/galeriadmin/edit/(:segment)', 'GaleriAdmin::edit/$1');
$routes->delete('/galeriadmin/(:num)', 'GaleriAdmin::delete/$1');
$routes->get('/galeriadmin/(:any)', 'GaleriAdmin::detail/$1');

// KUIS
$routes->get('/kuisadmin/create', 'KuisAdmin::create');
$routes->get('/kuisadmin/edit/(:segment)', 'KuisAdmin::edit/$1');
$routes->delete('/kuisadmin/(:num)', 'kuisAdmin::delete/$1');
$routes->get('/kuisadmin/(:any)', 'KuisAdmin::detail/$1');

// PESAN
$routes->delete('/pesan/(:num)', 'Pesan::delete/$1');
$routes->get('/pesan/(:any)', 'Pesan::detail/$1');

// USER
$routes->get('/tokohkerajaan/(:any)', 'TokohKerajaan::detail/$1');
$routes->get('/kerajaan/(:any)', 'Kerajaan::detail/$1');
$routes->get('/galeri/(:any)', 'Galeri::detail/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}