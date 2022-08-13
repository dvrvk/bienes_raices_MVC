<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate (string  $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : void {
    session_start();
    
    if(!$_SESSION['login']) {
        header('location: /');
    }

}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa el HTML
function s($html) : string {
    $s = htmlspecialchars($html); //evita inyección SQL
    return $s;
}

//Validar tipo de contenido
function validarTipoContenido ($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

//Recortar el texto de los anuncios 
function truncate(string $texto, int $cantidad) : string
{
    if(strlen($texto) >= $cantidad) {
        return substr($texto, 0, $cantidad) . "...";
    } else {
        return $texto;
    }
}

//Recargar la página y limpiar mensajes (exito, error)
function limpiarMensajes ($resultado, int $tiempo){
    if($resultado) {
    header("refresh: $tiempo; url= /admin");
}

}

//validar la URL por id valido
function validarORedireccionar (string $url) {
    
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT); //filtro que el id sea un nº
    if(!$id) {
        header("Location: ${url}");
    }

    return $id;
}