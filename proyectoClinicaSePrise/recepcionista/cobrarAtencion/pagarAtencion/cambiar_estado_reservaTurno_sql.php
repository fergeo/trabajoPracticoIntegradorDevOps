<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idReservaTurno = $_POST['idReservaTurno'];
    $formaPago = $_POST['formaPago'];
    $cuota = $_POST['cuota'];
    $costo = $costo['costo'];

    if($cuota == 1){
        $costoFinal = $costo;
    }
    elseif($cuota == 3){
        $costoFinal = $costo * 1.15;
    }
    elseif($cuota == 6){
        $costoFinal = $costo * 1.2;
    }
    
    $update = "update reservaturno set estado = 'Pagado' where idReservaTurno = '$idReservaTurno'";
    $resultado_update = mysqli_query($conexion,$update); 

    $alta = "insert into pagoatencion values(NULL,'$idReservaTurno','$costo','$costoFinal','$formaPago','$cuota')";
    $resultado_alta = mysqli_query($conexion,$alta);

    $fecha = date("d/m/Y");
    header("Location: http://localhost/proyectoClinicaSePrise/recepcionista/cobrarAtencion/cobrarAtencion.php?fecha=$fecha");
    
?>