<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    $idSalaEstudio = $_GET['idSalaEstudio'];
    $idInsumo = $_GET['idInsumo'];
    
    //echo "<scrip>alert(".$idSalaEstudio." ".$idInsumo.");</script>";

    // Hacemos la baja del registro
    $baja = "delete from salaEstudioInsumo where idSalaEsudio = '$idSalaEstudio' and idInsumo = '$idInsumo'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:salaEstudioInsumo.php?idSalaEstudio=$idSalaEstudio");
    

?>