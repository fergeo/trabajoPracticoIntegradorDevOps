<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    $idReservaTurno = $_GET['idReservaTurno'];
    $fecha = $_GET['fecha'];
    $idTurno = $_GET['idTurno'];

    echo "<script>alert('turno reserva: $idReservaTurno')</script>";
    
    // Hacemos la baja del registro
    $baja = "delete from reservaturno where idReservaTurno = '$idReservaTurno'";
    $resultado_baja = mysqli_query($conexion,$baja);

    //echo "<script>alert( 'turno ' $idTurno)</script>";

    $update = "update turno set estadoTurno = 0 where idTurno = '$idTurno'";
    $resultado_update = mysqli_query($conexion,$update); 

    header("Location:diaTurno.php?fecha=$fecha");

?>