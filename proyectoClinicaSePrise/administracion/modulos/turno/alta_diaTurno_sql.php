<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $idEspecialista = $_POST['idEspecialista'];
    $costo = $_POST['costo'];

    //echo "<script>alert('alert')</script>";
    
    // Verificamos si existe el usuario.
    $consulta1 = "select count(distinct 1) as nuevo from turno where diaTurno = '$fecha' and horaTurno = '$hora' and idEspecialista = '$idEspecialista' ";
    $resultado1 = mysqli_query($conexion,$consulta1);
    
    while($a = mysqli_fetch_assoc($resultado1)){
        $existe = $a['nuevo'];
    }

    // Estructura de decisión
    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: diaturno.php?mensaje=uno&fecha=$fecha");
    }else{
        
        // El usuario no existe, permitimos la carga.
        $alta = "insert into turno values(NULL,'$fecha','$hora','$idEspecialista','$costo','0')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location: diaturno.php?fecha=$fecha");
    }
        
?>