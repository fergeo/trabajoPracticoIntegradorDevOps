<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idSalaEstudio = $_POST['idSalaEstudio'];
    $idInsumo = $_POST['idInsumo'];

    //Verificamos si ya existe la relacion Sala de Esudios-Insumos.
    $consulta = "select count(distinct 1) as existe from salaEstudioInsumo where idSalaEstudio = '$idSalaEstudio' and idInsumo = '$idInsumo'";
    $resultado = mysqli_query($conexion,$consulta);
            
    while($a = mysqli_fetch_assoc($resultado)){
        $existe = $a['existe'];
    }

    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: salaEstudioInsumo.php?mensaje=uno&idConsultorio=$idSalaEstudio");
    }
    else{
    
        // El usuario no existe, permitimos la carga.
        $alta = "insert into salaEstudioInsumo values('$idSalaEstudio','$idInsumo')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location:salaEstudioInsumo.php?idSalaEstudio=$idSalaEstudio");
    }
?>