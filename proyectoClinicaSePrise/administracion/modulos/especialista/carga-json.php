<?php

    class Consultorio {
        // Propiedades
        public $idConsultorio;
        public $nombreConsultorio;

        // Constructor
        public function __construct($idConsultorio, $nombreConsultorio) {
            $this->idConsultorio = $idConsultorio;
            $this->nombreConsultorio = $nombreConsultorio;
        }
    }


    class SalaEstudio{
        // Propiedades
        public $idSalaEstudio;
        public $salaEstudioNombre;

        // Constructor
        public function __construct($idSalaEstudio, $salaEstudioNombre) {
            $this->idSalaEstudio = $idSalaEstudio;
            $this->salaEstudioNombre = $salaEstudioNombre;
        }
    }


    require("../../../inc/conexion.php");
    $data = [];
    $data1 = [];

    $consulta = "select distinct idConsultorio, consultorioNombre from consultorio";
    $resultado = mysqli_query($conexion,$consulta);

    array_push($data, new Consultorio('x', 'Elegir una opción'));
    while($fila = mysqli_fetch_assoc($resultado)){
        array_push($data, new Consultorio($fila['idConsultorio'], $fila['consultorioNombre']));
    }

    // Convertir el array a JSON
    $jsonData = json_encode($data, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT lo formatea de manera legible

    // Especificar el nombre del archivo
    $nombreArchivo = 'consultorios.json';

    // Guardar el JSON en el archivo
    $guardar = file_put_contents($nombreArchivo, $jsonData);



    //Para generar el json de las Salas de Estudios.
    $consulta1 = "select distinct idSalaEstudio, salaEstudioNombre from salaestudio";
    $resultado1 = mysqli_query($conexion,$consulta1);

    array_push($data1, new SalaEstudio('x', 'Elegir una opción'));
    while($fila1 = mysqli_fetch_assoc($resultado1)){
        array_push($data1, new SalaEstudio($fila1['idSalaEstudio'], $fila1['salaEstudioNombre']));
    }

    // Convertir el array a JSON
    $jsonData1 = json_encode($data1, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT lo formatea de manera legible

    // Especificar el nombre del archivo
    $nombreArchivo1 = 'salasEstudios.json';

    // Guardar el JSON en el archivo
    $guardar1 = file_put_contents($nombreArchivo1, $jsonData1);

?>