<?php
    
    // Agrego conexión a BDD
    require("../../inc/conexion.php");

    // Tomo los datos del formulario
    $nroDoc = $_POST['nroDoc'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $domicilio = $_POST['domicilio'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $poseeOS = $_POST['poseeOS'];

    // Verificamos si existe el usuario.
    $consulta1 = "select count(distinct nombrePaciente) as nuevo from paciente where numDocumentoPaciente = '$nroDoc' ";
    $resultado1 = mysqli_query($conexion,$consulta1);
    
    while($a = mysqli_fetch_assoc($resultado1)){
        $existe = $a['nuevo'];
    }

    // Estructura de decisión
    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: registro.php?mensaje=uno");
    }else{

        $alta = "insert into paciente values(NULL,'$nroDoc','$nombre','$apellido','$domicilio','$email','$telefono','$poseeOS')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location: http://localhost/proyectoClinicaSePrise/recepcionista/registro/regisro.php");
    }
?>