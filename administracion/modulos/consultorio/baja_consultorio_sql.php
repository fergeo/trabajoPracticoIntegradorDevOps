<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    // Busco los datos en el POST
    $idConsultorio = $_GET['idConsultorio'];

    // Hacemos la baja del registro
    $baja = "delete from consultorio where idConsultorio = '$idConsultorio'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:consultorio.php");

?>