<?php

namespace Config;

use PHPUnit\TextUI\XmlConfiguration\Group;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'App\Controllers\Home::index');
// $routes->get('/aboutus', 'Home::aboutus');

$routes->get('/', 'Home::home');
$routes->get('/aboutus', 'Home::aboutus');
// $routes->get('/ruangadmin/login', 'Login::index');
// $routes->post('/ruangadmin/login/action', 'Login::action');
$routes->group('/news', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'News::index');
});

$routes->group('/ruangadmin/login', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Login::index');
    $routes->post('action', 'login::action');
});

$routes->group('ruangadmin', ['filter' => 'cekLogin', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');
    $routes->group('users', ['filter' => 'hasAdmin', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
        $routes->get('/', 'Users::index');
        $routes->post('store', 'Users::store');
        $routes->post('delete', 'Users::delete');
        $routes->post('update', 'Users::update');
        $routes->post('reset/(:any)', 'Users::reset_/$1');
        $routes->post('set/(:any)', 'Users::set_/$1');
        $routes->post('delete-multiple', 'Users::deleteMultiple');
        $routes->post('reset-multiple', 'Users::resetMultiple');
        $routes->post('set-multiple', 'Users::setMultiple');
    });
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->group('data', ['filter' => 'cekLogin', 'namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('users', 'Admin::dataUsers');
        $routes->get('category', 'Admin::dataCategory');

        $routes->group('row', ['namespace' => 'App\Controllers\Api'], function ($routes) {
            $routes->post('users/(:any)', 'Admin::dataUsers');
        });
    });
});


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
