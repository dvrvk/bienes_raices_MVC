/// <reference types="cypress" />

describe('Carga la Página Principal', ()=>{
    it('Prueba el Header de la Página principal', ()=>{
        cy.visit('/');
        
        //Estos dos de abajo no se deben utilizar son muy genericos. 
        //document.querySelector('h1').textContent;
        //cy.get('h1')

        cy.get('[data-cy="heading-sitio"]').should('exist');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal','Venta de Propiedades y Apartamentos Exclusivos de Lujo');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal','Bienes Raices');
        //cy.get() te permite conseguir el elemento
        //should() ---> assertion --> debe (un texto sea igual a, elemento exista, exista una clase)
        //invoke() ---> lee el texto del interior
    });

    it('Prueba el Bloque de los iconos princiales', ()=>{
        cy.get('[data-cy="heading-nosotros"]').should('exist');
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2');
        //have.prop --> revisa que tenga una propiedad //tagName --_> nombre/tipo etiqueta 

        //Selecciona los icionos
        cy.get('[data-cy="iconos-nosotros"]').should('exist');
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 4);
        //find() --> buscar elementos dentro del que seleccione
        //have.length --> que tenga una extensión
    });

    it('Prueba el bloque de propiedades', ()=>{
        cy.get('[data-cy="heading-propiedades"]').should('exist');
        cy.get('[data-cy="heading-propiedades"]').should('have.prop', 'tagName').should('equal', 'H2');

        //Existan 3 propiedades
        cy.get('[data-cy="anuncio"]').should('have.length', 3);
        cy.get('[data-cy="anuncio"]').should('not.have.length', 4);

        //Probar el enlace de las propiedades
        cy.get('[data-cy="enlace-propiedad"]').should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad');

        //Probar el enlace a una propiedad
        cy.get('[data-cy="enlace-propiedad"]').first().click();
            //click() --> como si hiciera click en el elemnto y luego compruebo que existe algún elemento de esa página
        cy.get('[data-cy="titulo-propiedad"]').should('exist');

        cy.wait(1000); //espera 1 seg
        cy.go('back');
            //cy.go('back) --> vuelve a la página principal

    });

    it('Prueba el routing hacia todas las propiedades', ()=>{
        cy.get('[data-cy="todas-propiedades"]').should('exist');
        cy.get('[data-cy="todas-propiedades"]').should('have.class', 'boton-verde');
        cy.get('[data-cy="todas-propiedades"]').invoke('attr','href').should('equal','/propiedades');
        //attr --> verifica atributos
        cy.get('[data-cy="todas-propiedades"]').click();
        cy.get('[data-cy="heading-todas-propiedades"]').invoke('text').should('equal','Casas en Venta');
        cy.wait(1000);
        cy.go('back');
    });

    it('Prueba el bloque de contacto', ()=>{
        cy.get('[data-cy="imagen-contacto"]').should('exist');
        cy.get('[data-cy="imagen-contacto"]').find('h2').invoke('text').should('equal', 'Encuentra la casa de tus sueños');
        cy.get('[data-cy="imagen-contacto"]').find('p').invoke('text').should('equal', 'Llena el formulario de contacto y un asesor se pondrá en contacto contigo');
        cy.get('[data-cy="imagen-contacto"]').find('a').invoke('attr','href')
            .then( href=>{
                cy.visit(href);
        });
        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.wait(1000);
        cy.visit('/');
    });

    it('Prueba los testimoniales y el Blog', ()=>{
        cy.get('[data-cy="blog"]').should('exist');
        cy.get('[data-cy="blog"]').find('h3').invoke('text').should('equal','Nuestro Blog');
        cy.get('[data-cy="blog"]').find('h3').invoke('text').should('not.equal','Blog');
        cy.get('[data-cy="blog"]').find('img').should('have.length', 2);
        //Se refire a que tenemos dos imagenes

        cy.get('[data-cy="testimoniales"').should('exist');
        cy.get('[data-cy="testimoniales"]').find('h3').invoke('text').should('equal','Testimoniales');
        cy.get('[data-cy="testimoniales"]').find('h3').invoke('text').should('not.equal','Nuestros Testimoniales');
    });
})