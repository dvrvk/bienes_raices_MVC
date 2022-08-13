<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadControllers;
use Model\Propiedad;

$router = new Router();

$router->get('/admin',[PropiedadControllers::class , 'index']);
$router->get('/propiedades/crear',[PropiedadControllers::class , 'crear']);
$router->post('/propiedades/crear',[PropiedadControllers::class , 'crear']);
$router->get('/propiedades/actualizar',[PropiedadControllers::class , 'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadControllers::class , 'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadControllers::class , 'eliminar']);

$router->comprobarRutas();
