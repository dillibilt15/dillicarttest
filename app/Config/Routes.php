<?php

namespace Config;

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


/* Admin Routes */
$routes->get('admin-login-view', 'AdminControllers/AdminUser::admin_login_view');
$routes->post('admin-login-check', 'AdminControllers/AdminUser::admin_login_check');

$routes->get('admin-dashboard', 'AdminControllers/AdminDashboard::index');

$routes->get('admin-plans', 'AdminControllers/AdminPlans::index');
/*end Admin Routes */

/* User Routes*/
 
$routes->get('/', 'UserControllers/User::index');
$routes->get('login-view', 'UserControllers/User::login_view');
$routes->post('login-check', 'UserControllers/User::login_check');
$routes->get('ci-default', 'UserControllers/User::ci_default_page');

$routes->get('user-dashboard', 'UserControllers/UserDashboard::index');

$routes->add('user-wallet', 'UserControllers/UserWallet::index');

$routes->add('plans', 'UserControllers/Plans::index');
$routes->add('my-cart', 'UserControllers/UserCart::index');
$routes->add('my-orders', 'UserControllers/UserOrders::index');
$routes->add('add-to-cart-item', 'UserControllers/UserCart::add_cart_item');

/*end User Routes */
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
