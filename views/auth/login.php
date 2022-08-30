<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-login">Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>
    <form data-cy="formulario-login" class="formulario" method="POST" action="/login">
    <fieldset>
            <legend>Email y Password</legend> 

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu email" id="email" name="email">

            <label for="password">Password</label>
            <input type="password" placeholder="Tu password" id="password" name="password">

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>