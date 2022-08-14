<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    class PropiedadControllers {
        public static function index(Router $router) { //Así me traigo el objeto de index.php

            //Recuperar propiedades
            $propiedades = Propiedad::all(); //Importo use Model\Propiedad y uso all para coger todas.
            
            //Recuperar vendedores
            $vendedores = Vendedor::all();

            //Muestra mensaje condicional
            $resultado = $_GET['resultado'] ?? null; //revisa que haya un get, sino es null
            limpiarMensajes($resultado, 10);

            $router->render('propiedades/admin', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores
            ]);
            //Llamo a la vista
        }

        public static function crear(Router $router) {
            $propiedad = new Propiedad;
            $vendedores = Vendedor::all();

            // Arreglo con mensajes de errores
            $errores = Propiedad::getErrores();
            
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Crear una nueva instancia
                $propiedad = new Propiedad($_POST['propiedad']);

                /* Subida de archivos*/
                    
                    //1. Generar nombre único
                $nombreImagen =md5(uniqid(rand(), true)) . ".jpg";

                    //2.Setear la imagen: 
                    //Realiza un resize a la imagen con intervention/image
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen); 
                }
                
                //Revisar que el arreglo de errores está vacio (isSet o empty)
                $errores = $propiedad->validar();
                
                //Si no hay errores se inserta
                if(empty($errores)){ 
                    
                    
                    //1. Crear carpeta imagenes
                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
                    //2. Subir la imagen al servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);

                    //3. Guarda en la base de datos
                    $propiedad->guardar();
                }
            }
    
                    $router->render('propiedades/crear', [
                        'propiedad' => $propiedad,
                        'vendedores' => $vendedores,
                        'errores' => $errores

                    ]);
        }

        public static function actualizar(Router $router) {
            $id = validarORedireccionar('/admin');

            $propiedad = Propiedad::find($id);

            $vendedores = Vendedor::all();

            // Arreglo con mensajes de errores
            $errores = Propiedad::getErrores();
            
            //Se ejecuta tras dar a enviar
            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                //Asignar atributos
                $args = $_POST['propiedad'];

                $propiedad->sincronizar($args);

                //Validación de errores
                $errores = $propiedad->validar();
                
                /*Subida de archivos*/
                //1. Generar nombre único
                $nombreImagen =md5(uniqid(rand(), true)) . ".jpg";

                //2.Setear la imagen: Realiza un resize a la imagen con intervention/image
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen); 
                }
                
                if(empty($errores)){ 
                    if($_FILES['propiedad']['tmp_name']['imagen']) {
                        //Almacenar la imagen (si existe una imagen)
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }

                    $propiedad->guardar();

                }   

            }

            $router->render('propiedades/actualizar', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }

        public static function eliminar() {
            //Validación id botón eliminar
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                //Validar id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                if ($id) {
                    $tipo = $_POST['tipo'];

                    if (validarTipoContenido($tipo)) {
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                            
                    }
                } 
            }
        }
    }