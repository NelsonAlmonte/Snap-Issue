<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->group('/', ['filter' => 'isloggedin'], static function($routes) {
    $routes->get('capture', 'Home::capture');
    $routes->get('map', 'Home::map');
    $routes->get('onboarding', 'Home::onboarding');
    $routes->get('profile/(:num)', 'User::profile/$1');
    $routes->get('profile/(:num)/edit', 'User::edit/$1');
});
$routes->get('/', 'Home::capture', ['filter' => 'isloggedin']);

$routes->group('auth', static function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('authenticate', 'Auth::authenticate');
    $routes->get('signup', 'Auth::signup');
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('v1', static function($routes) {
    $routes->group('issue', static function($routes) {
        $routes->post('', 'Issue::save');
        $routes->get('', 'Issue::getIssues');
    });
    $routes->group('category', static function($routes) {
        $routes->get('', 'Category::getCategories');
    });
    $routes->group('user', static function($routes) {
        $routes->get('getUser', 'User::getUser');
        $routes->put('', 'User::updateUser');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
