nombre = document.getElementById("nombre");
nombre.addEventListener("change", function() {
    document.getElementById("nombreAux").value = nombre.value;
});


apellido = document.getElementById("apellido");
apellido.addEventListener("change", function() {
    document.getElementById("apellidoAux").value = apellido.value;
});


matricula = document.getElementById("matricula");
matricula.addEventListener("change", function() {
    document.getElementById("matriculaAux").value = matricula.value;
});


consultorioSalaEspacio = document.getElementById("consultorioSalaEspacio");
consultorioSalaEspacio.addEventListener("change", function() {
    // Obtenemos el valor del select
    selectValor = document.getElementById("consultorioSalaEspacio").value;
    // Asignamos el valor al input
    document.getElementById("consultorioSalaAux").value = selectValor;


    espacios = document.getElementById('espacios');
    espacios.innerHTML = "";
    
    if(selectValor == 'Consultorio'){
        fetch('consultorios.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar el JSON');
                }
                return response.json(); // Convertir la respuesta a JSON
            })
            .then(data => {
                data.forEach(opcion => {
                    const option = document.createElement("option");
                    option.value = opcion.idConsultorio;
                    option.textContent = opcion.nombreConsultorio;
                    espacios.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    else if(selectValor == 'Sala de Estudios'){
        fetch('salasEstudios.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar el JSON');
            }
            return response.json(); // Convertir la respuesta a JSON
        })
        .then(data => {
            data.forEach(opcion => {
                const option = document.createElement("option");
                option.value = opcion.idSalaEstudio;
                option.textContent = opcion.salaEstudioNombre;
                espacios.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    espacios.appendChild(option);
});

console.log('aqyu');
                            
if(document.getElementById("espacios")){
        console.log('espacios0');
    espacios = document.getElementById("espacios");
        console.log('espacios');
    espacios.addEventListener("change", function() {
        selectValor = document.getElementById("espacios").value;
        document.getElementById("espacioAux").value = selectValor;
    });
}








