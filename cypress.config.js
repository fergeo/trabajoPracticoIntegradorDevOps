const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: "http://localhost/",  // <= FUNDAMENTAL: termina con /
    supportFile: false,

    specPattern: "cypress/e2e/**/*.spec.js",

    viewportWidth: 1280,
    viewportHeight: 720,

    defaultCommandTimeout: 8000,
    requestTimeout: 8000,
    responseTimeout: 8000,

    setupNodeEvents(on, config) {
      // eventos opcionales
    },
  },
});
