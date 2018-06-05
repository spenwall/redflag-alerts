describe('My First Test', function () {
    it('Register Test', function () {
        //Arrange
        cy.visit('/register');

        //act
        let randomAccount = Math.floor((Math.random() * 100) + 1);
        cy.get('#name').type('Some Name');
        cy.get('#email').type('test'+ randomAccount + '@gmail.com');
        cy.get('#phone').type(4035557373);
        cy.get('#password').type('testpassword');
        cy.get('#password-confirm').type('testpassword');
        cy.get('button[type=submit]').click();

        cy.get('#add-alert').click(); 
        cy.get('#name').type('test name');
        cy.get('#keywords').type('off');
        cy.get('button[type=submit]').click();
        cy.wait(500);
        cy.get('.alert-item').should('contain', 'off');

    });
});