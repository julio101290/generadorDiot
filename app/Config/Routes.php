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
$routes->get('/', 'Home::index');




$routes->group('admin', function ($routes) {


    $routes->get('generateCRUD/(:any)', 'AutoCrudController::index/$1');



    $routes->resource('diot', [
        'filter' => 'permission:diot-permission',
        'controller' => 'diotController',
        'except' => 'show'
    ]);
    $routes->post('diot/save', 'DiotController::save');
    $routes->post('diot/getDiot', 'DiotController::getDiot');
    $routes->post('diot/saveXLS', 'DiotController::ctrSubirExcel');

    $routes->get('diot/diotArchivo', 'DiotController::archivosDIOT');

    $routes->post('diot/deleteDiotUUID', 'DiotController::deleteUUID');

    $routes->get('generaDIOT/(:any)', 'DiotController::generateDIOT/$1');

    $routes->resource('settingsrfc', [
        'filter' => 'permission:settingsrfc-permission',
        'controller' => 'settingsrfcController',
        'except' => 'show'
    ]);
    $routes->post('settingsrfc/save', 'SettingsrfcController::save');
    $routes->post('settingsrfc/getSettingsrfc', 'SettingsrfcController::getSettingsrfc');
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
