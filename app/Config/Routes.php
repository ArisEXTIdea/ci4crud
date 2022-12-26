<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

// CUSTOME ROUTE

// RENDER VIEW
$routes->get('/tambah-akun', '\App\Modules\Siakun\Controllers\Siakun::render_form_add');
$routes->get('/', '\App\Modules\Siakun\Controllers\Siakun::render_dashboard');
$routes->get('/detail-user/(:any)', '\App\Modules\Siakun\Controllers\Siakun::render_user_detail');
$routes->get('/edit-data-user/(:any)', '\App\Modules\Siakun\Controllers\Siakun::render_user_edit');
$routes->get('/edit-data-user-image/(:any)', '\App\Modules\Siakun\Controllers\Siakun::render_user_edit_image');


// FUNCTION

$routes->post('/saveData', '\App\Modules\Siakun\Controllers\Siakun::save_data_user');
$routes->post('/updateData', '\App\Modules\Siakun\Controllers\Siakun::update_data_user');
$routes->post('/updateDataImage', '\App\Modules\Siakun\Controllers\Siakun::update_data_user_image');
$routes->get('/deleteData/(:any)', '\App\Modules\Siakun\Controllers\Siakun::delete_data');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
