<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idReservaTurno = $_GET['idReservaTurno'];
    
    $update = "update reservaturno set estado = 'En Espera' where idReservaTurno = '$idReservaTurno'";
    $resultado_update = mysqli_query($conexion,$update); 
    
    header("Location: cambiaEstado.php?fecha=$fecha");
    
?>