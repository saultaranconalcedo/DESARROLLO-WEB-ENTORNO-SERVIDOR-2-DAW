<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Rutas para el panel de proyectos
$routes->get('/proyectos', 'Proyectos::index');
$routes->get('/proyectos/(:num)', 'Proyectos::detalle/$1');