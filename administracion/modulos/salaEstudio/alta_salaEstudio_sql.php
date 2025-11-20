<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $salaEstudio = $_POST['salaEstudio'];
    $area = $_POST['area'];

    // Verificamos si existe el usuario.
    $consulta = "select count(distinct salaestudioNombre) as nuevo from salaestudio where salaestudionombre = '$salaEstudio' ";
    $resultado = mysqli_query($conexion,$consulta);
    
    while($a = mysqli_fetch_assoc($resultado)){
        $existe = $a['nuevo'];
    }

    // Estructura de decisión
    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: salaestudio.php?mensaje=uno");
    }
    else{
    
        // El usuario no existe, permitimos la carga.
        $alta = "insert into salaestudio values(NULL,'$salaEstudio','$area')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location: salaestudio.php?idSalaEstudio=$idSalaEstudio");
    }
?>