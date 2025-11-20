<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idTurno = $_GET['idTurno'];
    $costo = $_GET['costo'];
    $fecha = $_GET['fecha'];
    
    session_start(); // Asegurarse de que la sesión esté iniciada
    // Verificar si la variable de sesión está definida
    if (isset($_SESSION['usuario'])) {
        $nroDNI = $_SESSION['usuario']; // Recuperar el valor de la sesión

        // Verificamos si existe el usuario.
        $consulta1 = "select distinct idPaciente as idPaciente, poseeObraSocial from paciente where numDocumentoPaciente = '$nroDNI' ";
        $resultado1 = mysqli_query($conexion,$consulta1);
    
        while($a = mysqli_fetch_assoc($resultado1)){
            $idPaciente = $a['idPaciente'];

            if($a['poseeObraSocial'] == 1){
                $montofinal = $costo - ($costo * 0.2);
            }

        }

        $update = "update turno set estadoTurno = 1 where idTurno = '$idTurno'";
        $resultado_update = mysqli_query($conexion,$update); 

        // El usuario no existe, permitimos la carga.
        $alta = "insert into reservaturno values(NULL,'$idTurno','$idPaciente','$montofinal','Ingresado')";
        $resultado_alta = mysqli_query($conexion,$alta);
    }
    else {
        echo "La variable de sesión 'nombre_variable' no está definida.";
    }

    // Redirigimos al usuario
    header("Location: diaturno.php?fecha=$fecha");
    
        
?>