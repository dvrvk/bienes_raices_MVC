<?php 

if(!isset($_SESSION)) { // Si no está definida arranco sesión
    session_start();
}
$auth = $_SESSION['login'] ?? false; // Si no existe null

if(!isset($inicio)) {
    $inicio = false;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

    <header class="header <?php echo /*isset($inicio)*/$inicio ? 'inicio' : '' ?> "> <!--evalua si inicio es true operador ternario if en una línea-->
        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <img  class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth) :?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif;?>
                    </nav>
                </div>

            </div> <!-- Cierre de la barra -->

            <?php 
            if($inicio) {
                echo "<h1 data-cy='heading-sitio'>Venta de Propiedades y Apartamentos Exclusivos de Lujo</h1>";
            }
            ?>
        </div>
    </header>
    
    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenido-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

 

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y')?> &copy;</p>

    </footer>
    <script src="../build/js/bundle.min.js"></script>
</body>
</html>