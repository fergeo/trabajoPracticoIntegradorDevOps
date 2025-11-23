<?php
    
    // Agrego conexión a BDD
    require("../../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idReservaTurno = $_POST['idReservaTurno'];
    $observacion = $_POST['observacion'];
    
    $update = "update reservaturno set estado = 'Atendido' where idReservaTurno = '$idReservaTurno'";
    $resultado_update = mysqli_query($conexion,$update); 

    $alta = "insert into observacion values(NULL,'$idReservaTurno','$observacion')";
    $resultado_alta = mysqli_query($conexion,$alta);

    $fecha = date("d/m/Y");
    header("Location: http://localhost/proyectoClinicaSePrise/doctor/cambiarEstado/consultorios/cambiaEstadoDoctorObs.php?fecha=$fecha");
    
?>