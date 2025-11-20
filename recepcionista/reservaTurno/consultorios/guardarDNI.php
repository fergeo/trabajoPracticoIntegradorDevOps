<?php

    $fecha = $_POST['fechaParam'];
    $dniPaciente = $_POST['dniPaciente'];

    echo "<script>alert('DNI: $dniPaciente');</script>";

    //session_start(); // Inicia la sesión
    //$_SESSION['dniPaciente'] = $dniPaciente;

    header("Location: diaturno.php?fecha=$fecha&dniPaciente=$dniPaciente");

?>