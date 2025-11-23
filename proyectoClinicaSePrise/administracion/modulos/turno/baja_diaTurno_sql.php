<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    // Busco los datos en el POST
    $idTurno = $_GET['idTurno'];
    $fecha = $_GET['fecha'];

    // Hacemos la baja del registro
    $baja = "delete from turno where idTurno = '$idTurno'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:diaturno.php?fecha=$fecha");

?>