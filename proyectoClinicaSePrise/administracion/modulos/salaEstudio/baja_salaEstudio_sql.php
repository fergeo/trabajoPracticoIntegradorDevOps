<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    // Busco los datos en el POST
    $idSalaEstudio = $_GET['idSalaEstudio'];

    // Hacemos la baja del registro
    $baja = "delete from salaestudio where idsalaestudio = '$idSalaEstudio'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location: salaestudio.php");

?>