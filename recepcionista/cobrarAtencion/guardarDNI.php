<?php

    $fecha = $_POST['fechaParam'];
    $dniPaciente = $_POST['dniPaciente'];

    session_start(); // Inicia la sesión
    $_SESSION['dniPaciente'] = $dniPaciente;

    //echo "<script>alert('$dniPaciente');</script>";
    header("Location: http://localhost/proyectoClinicaSePrise/doctor/cambiarEstado/consultorios/cambiaEstadoDoctorObs.php?fecha=$fecha&dniPaciemte=$dniPaciemte");

?>