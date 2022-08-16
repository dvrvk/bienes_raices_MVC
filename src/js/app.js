document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme : dark )');
    //console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }    
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}


function eventListeners() {
    const mobilMenu = document.querySelector('.mobile-menu');
    mobilMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales (cuando es más de uno All no puedes usar AddEventListener)
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    //MUY UTIL (solución)
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    // if (navegacion.classList.contains('mostrar')){
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');

    // }

    navegacion.classList.toggle('mostrar'); // lo mismo que lo anterior

}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Número Teléfono</label>
            <input type="tel" placeholder="Tu teléfono" id="telefono" name="contacto[telefono]">

            <p>Elija una fecha y hora para ser contactado</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">
            
            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>
        `;
    }
    
}