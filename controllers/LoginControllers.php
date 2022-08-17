<?php 

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginControllers {
    public static function login(Router $router) {
        
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Instancia de los datos
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)){
                //Verificar que el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    //Si no existe usuario mensaje de error
                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado) {
                        //Atenticar al usuario
                        $auth->autenticar();
                    } else {
                        //Si no es correcta la contraseña mensaje de error
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = []; //Cerramos sesión

        header('Location: /');

        debuguear($_SESSION);
    }
}