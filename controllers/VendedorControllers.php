<?php 

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorControllers {
    public static function crear(Router $router) {
        $vendedor = new Vendedor();

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        //Se ejecuta tras dar a enviar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Validar que no haya campos vacios
            $errores = $vendedor->validar();

            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear',[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        //Conseguir id de la URL
        $id = validarORedireccionar('/admin');

        //Consultar Datos Vendedor por id
        $vendedor = Vendedor::find($id);

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        //Se ejecuta tras dar a enviar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //asignar los valores
            $args = $_POST['vendedor'];

            //Sincronizar objeto en memoria
            $vendedor->sincronizar($args);

            //Validación
            $errores = $vendedor->validar();

            //Actualizar si no hay errores
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}