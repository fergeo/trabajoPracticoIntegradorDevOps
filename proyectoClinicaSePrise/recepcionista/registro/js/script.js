modificar = document.getElementById("modificar");


modificar.addEventListener("click",function(){
    idInsumo = document.getElementById("idInsumo");

    document.getElementById('nombre').innerHTML = document.getElementById("nombre");
});


const poseeOSCheckbox = document.getElementById("poseeOS");
const inputObraSocial = document.getElementById("obraSocial");

// Agregamos un listener para el evento "change" del checkbox
poseeOSCheckbox.addEventListener("change", function() {

    const inputObraSocial = document.createElement('input');
    inputObraSocial.type = 'text';        // Tipo de input (texto)
    inputObraSocial.name = 'numeroObraSocial'; // Nombre del input
    inputObraSocial.id = 'numeroObraSocial';   // ID del input
    inputObraSocial.placeholder = 'Número de obra social'; // Placeholder para el input

    // Agregamos el input al contenedor
    contenedorObraSocial.appendChild(inputObraSocial);

    // Si el checkbox está marcado, mostramos el campo de entrada
    if (this.checked) {
        inputObraSocial.style.display = "block";
    } else {
        // Si está desmarcado, lo ocultamos
        inputObraSocial.style.display = "none";
    }
});


