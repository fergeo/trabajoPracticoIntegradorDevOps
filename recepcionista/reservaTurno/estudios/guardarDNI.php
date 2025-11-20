<?php

    $fecha = $_POST['fechaParam'];
    $dniPaciente = $_POST['dniPaciente'];

    session_start(); // Inicia la sesión
    $_SESSION['dniPaciente'] = $dniPaciente;

    //echo "<script>alert('$dniPaciente');</script>";
    header("Location: diaturno.php?fecha=$fecha&dniPaciemte=$dniPaciemte");

?>