describe('My First Test', function () {
    it('Does not do much', function () {
        //Arrange
        cy.visit('/')

        //act
        cy.get('#email').type('dude.wallace@gmail.com')
        cy.get('#password').type('f72vforp')
        cy.get('button[type=submit]').click() 

        let title = cy.get('h1')
        cy.assertEquals(title, 'Alerts')
        //assert
    })
})