<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idTurno = $_GET['idTurno'];
    $costo = $_GET['costo'];
    $fecha = $_GET['fecha'];
    //$dniPaciente = $_GET['dniPaciente'];

    session_start();
    $dniPaciente = $_SESSION['dniPaciente'];
    //echo "<script>alert('$dniPaciente');</script>";

    if ($dniPaciente != ""){
        
        $consulta1 = "select distinct idPaciente as idPaciente, poseeObraSocial from paciente where numDocumentoPaciente = '$dniPaciente' ";
        $resultado1 = mysqli_query($conexion,$consulta1);
    
        while($a = mysqli_fetch_assoc($resultado1)){
            $idPaciente = $a['idPaciente'];

            if($a['poseeObraSocial'] == 1){
                $montofinal = $costo - ($costo * 0.2);
            }
        }

        if($idPaciente != ""){
            $update = "update turno set estadoTurno = 1 where idTurno = '$idTurno'";
            $resultado_update = mysqli_query($conexion,$update); 
    
            $alta = "insert into reservaturno values(NULL,'$idTurno','$idPaciente','$montofinal','Ingresado')";
            $resultado_alta = mysqli_query($conexion,$alta);
        }

        // Redirigimos al usuario
        header("Location: diaturno.php?fecha=$fecha");
    } else {
        echo "No hay un dniPaciente guardado en la sesión.";
    }

    
        
?>