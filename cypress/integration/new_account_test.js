describe('My First Test', function () {
    it('Basic Test', function () {
        //Arrange
        cy.visit('/register')

        //act
        cy.get('#name').type('Spencer Test')
        cy.get('#email').type('test10@gmail.com')
        cy.get('#password').type('testpassword')
        cy.get('#password-confirm').type('testpassword')
        cy.get('button[type=submit]').click() 

        cy.get('#add-alert').click() 
        cy.get('#name').type('test name')
        cy.get('#keywords').type('off')
        cy.get('button[type=submit]').click()
        cy.wait(500)
        cy.get('.alert-item').should('contain', 'off')
    })
})