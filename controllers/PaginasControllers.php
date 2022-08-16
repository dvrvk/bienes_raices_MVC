<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasControllers {
    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);
        $inicio = true; //Para la foto del header

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){

        $router->render('/paginas/nosotros', []);

    }

    public static function propiedades(Router $router){
        
        $propiedades = Propiedad::all(); //Cambiar para paginación

        $router->render('/paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad
        ]);

    }

    public static function blog(Router $router){
        
        $router->render('/paginas/blog', []);

    }

    public static function entrada(Router $router){

        $router->render('/paginas/entrada', []);
    }

    public static function contacto(Router $router){
        
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP (sacar de mailtrap - servidormail)
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io'; //MAIL_HOST (mailtrap)
            $mail->SMTPAuth = true; //Nos vamos a autenticar
            $mail->Username = '767657e34e57f1'; //MAIL_USERNAME (mailtrap)
            $mail->Password = '91f2443b0fd30c'; //MAIL_PASSWORD (mailtrap)
            $mail->SMTPSecure = 'tls'; //tls es la recomendada
            $mail->Port = 2525; //MAIL_PORT (mailtrap)

            //Configurar el contenido del email
            $mail->setFrom('diego95vazquez@gmail.com'); //Desde donde se envia (pon uno conocido para que no vaya a no deseados)
            $mail->addAddress('diego95vazquez@gmail.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un mensaje nuevo';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            
            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre: ' . $respuestas['nombre'] .'</p>';
            $contenido .= '<p> Mensaje: ' . $respuestas['mensaje'] .'</p>';
            $contenido .= '<p> Vende o compra: ' . $respuestas['tipo'] .'</p>';
            $contenido .= '<p> Precio o Presupuesto: ' . $respuestas['precio'] .'€ </p>';
            $contenido .= '<p> Prefiere ser contactado por: ' . $respuestas['contacto'] .'</p>';

            //Enviar de forma condicional campos de email o teléfono
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p> Teléfono: ' . $respuestas['telefono'] .'</p>';
                $contenido .= '<p> Fecha contacto: ' . $respuestas['fecha'] .'</p>';
                $contenido .= '<p> Hora contacto: ' . $respuestas['hora'] .'</p>';
            } else {
                //Es email
                $contenido .= '<p> Email: ' . $respuestas['email'] .'</p>';
            }
            
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alternativo sin HTML';

            //Enviar el email
            if($mail->send()){
                $mensaje =  "Mensaje enviado correctamente";
            } else {
                $mensaje = "El Mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
        
    }
}