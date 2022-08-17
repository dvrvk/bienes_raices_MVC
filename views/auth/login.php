<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" action="/login">
    <fieldset>
            <legend>Email y Password</legend> 

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu email" id="email" name="email">

            <label for="password">Teléfono</label>
            <input type="password" placeholder="Tu password" id="password" name="password">

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>