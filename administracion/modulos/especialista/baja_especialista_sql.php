<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    // Busco los datos en el POST
    $idEspecialista = $_GET['idEspecialista'];

    // Hacemos la baja del registro
    $baja = "delete from especialista where idEspecialista = '$idEspecialista'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:especialista.php");
?>