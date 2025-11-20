<?php

    
    class Dia {
        // Propiedades
        public $dia;
        public $mes;
        public $anio;

        // Constructor
        public function __construct($dia, $mes, $anio) {
            $this->dia = $dia;
            $this->mes = $mes;
            $this->anio = $anio;
        }
    }


    require("../../../inc/conexion.php");
    $data = [];
    

    $consulta = "select DISTINCT substring(diaturno,1,2) as dia, substring(diaturno,4,2) as mes, substring(diaturno,7) as anio from turno;";
    $resultado = mysqli_query($conexion,$consulta);

    while($fila = mysqli_fetch_assoc($resultado)){
        array_push($data, new Dia($fila['dia'],$fila['mes'],$fila['anio']));
    }

    // Convertir el array a JSON
    $jsonData = json_encode($data, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT lo formatea de manera legible

    // Especificar el nombre del archivo
    $nombreArchivo = 'dias.json';

    // Guardar el JSON en el archivo
    $guardar = file_put_contents($nombreArchivo, $jsonData);
?>