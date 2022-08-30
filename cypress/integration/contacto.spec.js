/// <reference types="cypress" />

describe('Prueba el Formulario de Contacto', ()=>{
    it('Prueba la página de contacto y el envio de emails', ()=> {
        cy.visit('/contacto');
        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'Formulario de Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'LLene el Formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'LLena el formulario');

        cy.get('[data-cy="formulario-contacto"]').should('exist');

    });

    it('LLena los campos del formulario', ()=>{
        cy.get('[data-cy="input-nombre"]').type('Diego');
        cy.get('[data-cy="input-mensaje"]').type('Deseo comprar una casa');
        //type: método para escribir.
        //select(): método para seleccionar.

        cy.get('[data-cy="input-opciones"]').select('Compra');
        cy.get('[data-cy="input-precio"]').type('250000');
        cy.get('[data-cy="forma-contacto"]').eq(1).check();
        //eq(indice) --> selecciona la opción del arreglo --> check() --> lo selecciona.
        cy.get('[data-cy="input-email"]').should('exist');
        

        cy.wait(3000);
        cy.get('[data-cy="forma-contacto"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type('635897746');
        cy.get('[data-cy="input-fecha"]').type('2022-10-30');
        cy.get('[data-cy="input-hora"]').type('15:30');
        
        cy.get('[data-cy="formulario-contacto"]').submit();
        //submit()-> envia el formulario
        cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
        cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal', 'Mensaje enviado correctamente');
        cy.get('[data-cy="alerta-envio-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class','error');
        //have.class -> indica que tiene una clase //and() --> agregar otra condición
        

    })
});