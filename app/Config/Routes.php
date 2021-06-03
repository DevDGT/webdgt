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
// $routes->get('/aboutus', 'Home::aboutus');

$routes->group('/abouts', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Abouts::index');
});

$routes->group('/news', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'News::index');
    $routes->get('read/article', 'News::article');
});

$routes->group('/ruangadmin/login', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Login::index');
    $routes->post('action', 'Login::action');
    $routes->post('destroy', 'Login::destroy');
});

$routes->group('ruangadmin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');
    // User Management routes
    $routes->group('users', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
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

    // Category Management routes
    $routes->group('category', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
        $routes->get('/', 'Category::index');
        $routes->post('store', 'Category::store');
        $routes->post('delete', 'Category::delete');
        $routes->post('update', 'Category::update');
        $routes->post('reset/(:any)', 'Category::reset_/$1');
        $routes->post('set/(:any)', 'Category::set_/$1');
        $routes->post('delete-multiple', 'Category::deleteMultiple');
        $routes->post('reset-multiple', 'Category::resetMultiple');
        $routes->post('set-multiple', 'Category::setMultiple');
    });

    // Tags Management routes
    $routes->group('tags', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
        $routes->get('/', 'Tags::index');
        $routes->post('store', 'Tags::store');
        $routes->post('delete', 'Tags::delete');
        $routes->post('update', 'Tags::update');
        $routes->post('reset/(:any)', 'Tags::reset_/$1');
        $routes->post('set/(:any)', 'Tags::set_/$1');
        $routes->post('delete-multiple', 'Tags::deleteMultiple');
        $routes->post('reset-multiple', 'Tags::resetMultiple');
        $routes->post('set-multiple', 'Tags::setMultiple');
    });

    $routes->group('article', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
        $routes->get('/', 'Article::index');
        $routes->post('check-title', 'Article::checkTitle');
        $routes->post('store', 'Article::store');
        $routes->post('update', 'Article::update');
        $routes->post('set/(:any)', 'Article::set_/$1');
        $routes->post('delete', 'Article::delete');
        $routes->post('uploads(:any)', 'Article::uploads');
        $routes->post('set/(:any)', 'Article::set_/$1');
        $routes->post('delete-multiple', 'Article::deleteMultiple');
        $routes->post('set-multiple', 'Article::setMultiple');
    });
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->group('data', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('options/(:any)', 'Admin::getDataOption/$1');
        $routes->post('users', 'Admin::dataUsers');
        $routes->post('category', 'Admin::dataCategory');
        $routes->post('tags', 'Admin::dataTags');
        $routes->post('article', 'Admin::dataArticle');
    });

    $routes->group('row', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('users/(:any)', 'Admin::getRowUsers/$1');
        $routes->post('category/(:any)', 'Admin::getRowCategory/$1');
        $routes->post('tags/(:any)', 'Admin::getRowTags/$1');
        $routes->post('article/(:any)', 'Admin::getRowArticle/$1');
    });

    $routes->group('public', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->group('get', ['namespace' => 'App\Controllers\Api'], function ($routes) {
            $routes->get('article', 'PublicApi::getArticle');
        });
    });
});

// Test Route
$routes->group('test', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Test::test');
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
