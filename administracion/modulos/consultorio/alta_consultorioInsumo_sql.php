<?php
    
    // Agrego conexión a BDD
    require("../../../inc/conexion.php");

    // Tomo los datos del formulario
    $idConsultorio = $_POST['idConsultorio'];
    $idInsumo = $_POST['idInsumo'];

    //echo "<script>alert('alert mensaje 1246')</script>";
    
    // Verificamos si existe la relacion Consultorio-Insumo.
    $consulta = "select count(distinct 1) as existe from consultorioInsumo where idConsultorio = '$idConsultorio' and idInsumo = '$idInsumo'";
    $resultado = mysqli_query($conexion,$consulta);
        
    while($a = mysqli_fetch_assoc($resultado)){
        $existe = $a['existe'];
    }
    
    if($existe==1){
        // Modifico el mensaje y volvemos al formulario
        header("Location: consultorioInsumo.php?mensaje=uno&idConsultorio=$idConsultorio");
    }
    else{
    
        // La convinacion consultorio insumo no existe, permitimos la carga.
        $alta = "insert into consultorioInsumo values('$idConsultorio','$idInsumo')";
        $resultado_alta = mysqli_query($conexion,$alta);

        // Redirigimos al usuario
        header("Location:consultorioInsumo.php?idConsultorio=$idConsultorio");
    }
?>