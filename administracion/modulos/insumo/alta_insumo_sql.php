<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $cantidadStock = $_POST['cantidad'];

    // Verificamos si existe el usuario.
    $consulta1 = "select count(distinct nombre) as nuevo from insumo where nombre = '$nombre' ";
    $resultado1 = mysqli_query($conexion,$consulta1);
    
    while($a = mysqli_fetch_assoc($resultado1)){
        $existe = $a['nuevo'];
    }

    // Estructura de decisión
    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: insumo.php?mensaje=uno");
    }else{
        $idInsumo = 0;
        $consulta1 = "select count(distinct nombre) as cantidad from insumo";
        $resultado1 = mysqli_query($conexion,$consulta1); 
        while($a = mysqli_fetch_assoc($resultado1)){
            $idInsumo = $a['cantidad'] + 1 ;
        }

        // El usuario no existe, permitimos la carga.
        $alta = "insert into insumo values(NULL,'$nombre','$descripcion','$cantidad','$cantidad')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location: insumo.php?");
    }
?>