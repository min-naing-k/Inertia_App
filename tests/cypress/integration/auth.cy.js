/// <reference types="cypress" />

describe('Authentication', () => {
  it('provides feedback for invalid login credentials', () => {
    cy.refreshDatabase();

    cy.visit('/login');

    cy.get('#email').type('test@gmail.com');
    cy.get('#password').type('111111');
    cy.contains('button', 'Login').click();
    cy.contains('The provided credentials do not match our records.')
      .should('be.visible');
  });

  it('signs a user and redirect to home page', () => {
    cy.refreshDatabase();

    cy.create('App\\Models\\User', { email: 'test@gmail.com' });

    cy.visit('/login');

    cy.get('#email').type('test@gmail.com');
    cy.get('#password').type('111111');
    cy.contains('button', 'Login').click();

    cy.assertRedirect('/');
  });
});