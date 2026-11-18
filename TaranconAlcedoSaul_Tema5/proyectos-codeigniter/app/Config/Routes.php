<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Rutas para el panel de proyectos
$routes->get('/proyectos', 'Proyectos::index');
$routes->get('/proyectos/(:num)', 'Proyectos::detalle/$1');

// Configuro estas dos rutas para tener URLs limpias y no usar ?id= como en el ejercicio anterior.
// Si entran a /proyectos se ejecuta el metodo index() del controlador Proyectos.
$routes->get('/proyectos', 'Proyectos::index');

// Con (:num) le digo que despues de /proyectos/ tiene que ir un numero (el ID),
// y con $1 le paso ese numero como parametro al metodo detalle($id).
$routes->get('/proyectos/(:num)', 'Proyectos::detalle/$1');