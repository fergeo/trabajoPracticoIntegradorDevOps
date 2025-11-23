<?php
    // Conexión al servidor de BDD
    include('../../inc/conexion.php');

    // Busco los datos en el POST
    $idPaciente = $_GET['idPaciente'];

    // Hacemos la baja del registro
    $baja = "delete from paciente where idPaciente = '$idPaciente'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:paciente.php");

?>