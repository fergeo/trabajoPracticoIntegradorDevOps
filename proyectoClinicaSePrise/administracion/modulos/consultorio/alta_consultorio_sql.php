<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $consultorio = $_POST['consultorio'];
    $area = $_POST['area'];

    // Verificamos si existe el usuario.
    $consulta = "select count(distinct consultorioNombre) as nuevo from consultorio where consultorioNombre = '$consultorio' ";
    $resultado = mysqli_query($conexion,$consulta);
    
    while($a = mysqli_fetch_assoc($resultado)){
        $existe = $a['nuevo'];
    }

    // Estructura de decisión
    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: consultorio.php?mensaje=uno");
    }
    else{
    
        // El usuario no existe, permitimos la carga.
        $alta = "insert into consultorio values(NULL,'$consultorio','$area')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location: consultorio.php?");
    }
?>