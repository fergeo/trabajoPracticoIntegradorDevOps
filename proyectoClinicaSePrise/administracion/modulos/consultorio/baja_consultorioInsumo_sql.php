<?php
    // Conexión al servidor de BDD
    include('../../../inc/conexion.php');

    // Busco los datos en el POST
    $idConsultorio = $_GET['idConsultorio'];
    $idInsumo = $_GET['idInsumo'];

    echo "<scrip>alert(".$idConsultorio." ".$idInsumo.");</script>";

    // Hacemos la baja del registro
    $baja = "delete from consultorioinsumo where idConsultorio = '$idConsultorio' and idInsumo = '$idInsumo'";
    $resultado_baja = mysqli_query($conexion,$baja);
    header("Location:consultorioInsumo.php?idConsultorio=$idConsultorio");
    

?>