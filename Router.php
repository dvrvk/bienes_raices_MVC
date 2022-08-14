<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        if (isset($_SERVER['PATH_INFO'])) {
            $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        } else {
            $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }

        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if($metodo === 'GET'){
            $urlActual = explode('?',$urlActual)[0];
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $urlActual = explode('?',$urlActual)[0];
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        
        if($fn) {
        //URL existe y tiene una función asociada
            call_user_func($fn, $this); 
                //Nos permite llamar una función cuando no sabes como se llama la función
        } else {
            echo "Pagina No Encontrada";
        }
            
        
    }

    //Muestra una vista
    public function render($view, $datos = []) {

        foreach ($datos as $key=>$value) {
            $$key = $value; //Variable de variable (lo convierte en una variable)
        }
        ob_start(); 
        //Iniciar un almacenamiento en memoria (lo de abajo)
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();
        //Limpiamos esa memoria

        include __DIR__ . "/views/layout.php";
    }   

 
}