// Archivo: cypress/e2e/flujoClinicaCompleto.spec.js

describe("Flujo Completo del Proyecto Clínica", () => {

    before(() => {
        cy.log("==== INICIO DE PRUEBA E2E COMPLETA ====");
    });

    beforeEach(() => {
        cy.log("---- Nuevo Caso de Prueba ----");
    });

    it("Carga del sitio inicial", () => {
        cy.log("1) Visitando la página principal...");
        cy.visit("/index.php");

        cy.log("2) Verificando que el título exista...");
        cy.contains("Clinica").should("exist");
    });

    it("Prueba de Login", () => {
        cy.log("1) Navegando al login...");
        cy.visit("/login.php");

        cy.log("2) Completando usuario...");
        cy.get('input[name="usuario"]').type("admin");

        cy.log("3) Completando contraseña...");
        cy.get('input[name="password"]').type("admin123");

        cy.log("4) Enviando formulario...");
        cy.get('button[type="submit"]').click();

        cy.log("5) Verificando redirección al menú...");
        cy.url().should("include", "/menu.php");
        cy.contains("Bienvenido").should("exist");
    });

    it("Listar pacientes", () => {
        cy.log("1) Visitando listado de pacientes...");
        cy.visit("/pacientes.php");

        cy.log("2) Verificando tabla...");
        cy.get("table").should("exist");

        cy.log("3) Verificando que hay filas...");
        cy.get("table tr").its("length").should("be.gt", 1);
    });

    it("Crear un nuevo paciente", () => {
        cy.log("1) Abriendo formulario nuevo paciente...");
        cy.visit("/pacienteNuevo.php");

        cy.log("2) Llenando nombre...");
        cy.get('input[name="nombre"]').type("Juan Test");

        cy.log("3) Llenando apellido...");
        cy.get('input[name="apellido"]').type("Pérez");

        cy.log("4) Llenando DNI...");
        cy.get('input[name="dni"]').type("12345678");

        cy.log("5) Guardando...");
        cy.get("button[type='submit']").click();

        cy.log("6) Verificando retorno al listado...");
        cy.url().should("include", "/pacientes.php");

        cy.log("7) Verificando existencia del paciente...");
        cy.contains("Juan Test").should("exist");
    });

    it("Editar paciente", () => {
        cy.log("1) Visitando pacientes...");
        cy.visit("/pacientes.php");

        cy.log("2) Clic en Editar...");
        cy.get("a.editar").first().click();

        cy.log("3) Modificando apellido...");
        cy.get('input[name="apellido"]').clear().type("Modificado");

        cy.log("4) Guardando...");
        cy.get("button[type='submit']").click();

        cy.log("5) Verificando cambio aplicado...");
        cy.contains("Modificado").should("exist");
    });

    it("Eliminar paciente", () => {
        cy.log("1) Visitando pacientes...");
        cy.visit("/pacientes.php");

        cy.log("2) Clic en eliminar...");
        cy.get("button.eliminar").first().click();

        cy.log("3) Confirmando diálogo...");
        cy.on("window:confirm", () => true);

        cy.log("4) Verificando eliminación...");
        cy.contains("Modificado").should("not.exist");
    });

    after(() => {
        cy.log("==== FIN DE TODA LA PRUEBA E2E ====");
    });

});
