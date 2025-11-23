// Archivo: cypress/e2e/flujoClinicaE2E.spec.js

describe("E2E Básico Proyecto Clínica", () => {
  // Cambia la URL base según tu servidor
  const baseUrl = "http://localhost/proyectoClinicaSePrise";

  before(() => {
    cy.log("==== INICIO DE PRUEBA E2E ====");
  });

  it("Login con usuario y contraseña válidos", () => {
    cy.visit(baseUrl + "/index.php");

    // Completar usuario y contraseña
    cy.get('input[name="usuario"]').type("admin");
    cy.get('input[name="password"]').type("admin123");

    // Click en Ingresar
    cy.get('button[type="submit"]').click();

    // Verificar que redirige a la página principal de administración
    cy.url().should("include", "/administracion/main-adm.php");

    // Verificar que un elemento visible en main-adm.php existe
    cy.contains("Administración").should("exist");
  });

  it("Acceder a módulo de Insumos y verificar tabla", () => {
    cy.visit(baseUrl + "/administracion/insumo/insumo.php");

    // Verificar que el título del módulo está visible
    cy.contains("Insumos").should("exist");

    // Verificar que al menos un botón de agregar exista
    cy.get("button.btn-add").should("exist");
  });

  it("Acceder a módulo de Salas de Estudio y verificar tabla", () => {
    cy.visit(baseUrl + "/administracion/salaEstudio/salaestudio.php");

    // Verificar que el título del módulo está visible
    cy.contains("Salas de Estudio").should("exist");

    // Verificar que al menos un botón de agregar exista
    cy.get("button.btn-add").should("exist");
  });

  it("Acceder a cobrar atención y buscar paciente", () => {
    cy.visit(baseUrl + "/recepcionista/cobroatencion.php");

    // Verificar que el formulario de DNI esté visible
    cy.get('input#dniPaciente').should("exist");

    // Completar un DNI de prueba
    cy.get('input#dniPaciente').type("12345678");

    // Click en buscar
    cy.get('button.btn-dni-gurdar').click();

    // Verificar que la tabla de resultados aparece
    cy.get("table.tables-turno").should("exist");
  });
});
`
