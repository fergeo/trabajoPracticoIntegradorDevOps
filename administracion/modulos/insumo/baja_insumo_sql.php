<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    // Busco los datos en el POST
    $idInsumo = $_GET['idInsumo'];

    // Hacemos la baja del registro
    $baja = "delete from insumo where idInsumo = '$idInsumo'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:insumo.php");

?>