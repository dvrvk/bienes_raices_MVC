<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadControllers;
use Controllers\VendedorControllers;
use Model\Propiedad;

$router = new Router();

$router->get('/admin',[PropiedadControllers::class , 'index']);
$router->get('/propiedades/crear',[PropiedadControllers::class , 'crear']);
$router->post('/propiedades/crear',[PropiedadControllers::class , 'crear']);
$router->get('/propiedades/actualizar',[PropiedadControllers::class , 'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadControllers::class , 'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadControllers::class , 'eliminar']);

$router->get('/vendedores/crear',[VendedorControllers::class , 'crear']);
$router->post('/vendedores/crear',[VendedorControllers::class , 'crear']);
$router->get('/vendedores/actualizar',[VendedorControllers::class , 'actualizar']);
$router->post('/vendedores/actualizar',[VendedorControllers::class , 'actualizar']);
$router->post('/vendedores/eliminar',[VendedorControllers::class , 'eliminar']);

$router->comprobarRutas();
