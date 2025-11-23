const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    // Base URL apunta a Nginx en localhost
    baseUrl: "http://localhost/",

    // No usamos archivo de soporte
    supportFile: false,

    // Patrón de los specs
    specPattern: "cypress/e2e/**/*.spec.js",

    // Tamaño de la ventana
    viewportWidth: 1280,
    viewportHeight: 720,

    // Tiempos de espera
    defaultCommandTimeout: 8000,
    requestTimeout: 8000,
    responseTimeout: 8000,

    setupNodeEvents(on, config) {
      // Eventos opcionales
    },
  },
});
