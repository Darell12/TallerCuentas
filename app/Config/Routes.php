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
$routes->setDefaultController('Principal'); //Nombre del controller arranque
$routes->setDefaultMethod('index'); //Metodo de arranque
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Principal::index');
///! RUTAS DE SESION
// $routes->get('login', 'Auth::login');
// $routes->post('login', 'Auth::login');
// $routes->get('logout', 'Auth::logout');

// ! RUTAS DE VISTAS TABLAS
$routes->get('/ver_paises', 'paises::index');
$routes->get('/ver_dptos', 'departamentos::index');
$routes->get('/ver_munis', 'municipios::index');
$routes->get('/ver_cargos', 'cargos::index');
$routes->get('/ver_empleados', 'empleados::index');


// ! RUTAS DE VISTAS TABLAS ELIMINADAS
$routes->get('/eliminados_paises', 'paises::eliminados');
$routes->get('/eliminados_cargos', 'cargos::eliminados');
$routes->get('/eliminados_empleados', 'empleados::eliminados');
$routes->get('/eliminados_municipios', 'municipios::eliminados');
$routes->get('/eliminados_departamentos', 'departamentos::eliminados');

//! RUTAS PARA INSERTAR
$routes->post('/paises_insertar', 'paises::insertar');
$routes->post('/cargos_insertar', 'cargos::insertar');
$routes->post('/empleados_insertar', 'empleados::insertar');
$routes->post('/municipios_insertar', 'municipios::insertar');
$routes->post('/dptos_insertar', 'departamentos::insertar');
$routes->post('/empleados_insertar', 'empleados::insertar');
$routes->post('/salarios_insertar', 'salarios::insertar');
// $routes->get('/paises/cambiarEstado/(:num)', 'Paises::cambiarEstado/$1');

// ! RUTAS PARA CAMBIAR ESTADOS
$routes->get('/estado_paises/(:num)/(:alpha)', 'paises::cambiarEstado/$1/$2');
$routes->get('/estado_cargos/(:num)/(:alpha)', 'cargos::cambiarEstado/$1/$2');
$routes->get('/estado_dptos/(:num)/(:alpha)', 'departamentos::cambiarEstado/$1/$2');
$routes->get('/estado_munis/(:num)/(:alpha)', 'municipios::cambiarEstado/$1/$2');
$routes->get('/estado_empleados/(:num)/(:alpha)', 'empleados::cambiarEstado/$1/$2');
$routes->post('/estado_salarios', 'salarios::cambiarEstado');

// ! RUTAS PARA OBTENER DATOS

//!RELACIONADOS A MUNICIPIOS
$routes->post('/buscar_munis/(:num)', 'municipios::Buscar_Muni/$1');
$routes->post('/buscar_dptos_muni/(:num)', 'municipios::obtenerDepartamentosPais/$1');
$routes->post('/buscar_muni_dptos/(:num)', 'municipios::obtenerMuniDpto/$1');
//!RELACIONADOS A EMPLEADO
$routes->post('/buscar_empleado/(:num)', 'empleados::buscar_Emp/$1');
$routes->post('/salarios_empleado/(:num)', 'empleados::salario_empleado/$1');
$routes->post('/salarios_eliminado/(:num)', 'empleados::salario_empleado_eliminados/$1');
$routes->post('/salario_empleado/(:num)', 'empleados::salario_id/$1');
//!RElACIONADOS A EDITAR 
$routes->post('/buscar_cargo/(:num)', 'cargos::buscar_Cargo/$1');
$routes->post('/buscar_pais/(:num)', 'paises::buscar_Pais/$1');
$routes->post('/buscar_dpto/(:num)', 'departamentos::buscar_Dpto/$1');
//!URLS DE VALIDACION DE CAMPOS
$routes->post('/paises_validar/(:segment)/(:segment)/(:num)', 'paises::validar_Campo/$1/$2/$3');
$routes->post('/cargos_validar/(:segment)/(:segment)/(:num)', 'cargos::validar_Campo/$1/$2/$3');
$routes->post('/municipios_validar/(:segment)/(:segment)/(:num)', 'municipios::validar_Campo/$1/$2/$3');
$routes->post('/departamentos_validar/(:segment)/(:segment)/(:num)', 'departamentos::validar_Campo/$1/$2/$3');


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
