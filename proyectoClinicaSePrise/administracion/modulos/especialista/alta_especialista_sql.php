<?php
    
    //echo "<script>alert('antes if ingreos')</script>";

    if (isset($_POST["nombreAux"])) {
        // Agrego conexión a BDD
        require("../../../inc/conexion.php");

        // Tomo los datos del formulario
        $nombre = $_POST['nombreAux'];
        $apellido = $_POST['apellidoAux'];
        $matricula = $_POST['matriculaAux'];
        $consultorioSalaEspacio = $_POST['consultorioSalaAux'];
        $espacio = $_POST['espacioAux'];

        // Verificamos si existe el usuario.
        $consulta = "select count(distinct matriculaEspecialista) as nuevo from especialista where matriculaEspecialista = '$matricula' ";
        $resultado = mysqli_query($conexion,$consulta);
    
        while($a = mysqli_fetch_assoc($resultado)){
            $existe = $a['nuevo'];
        }

        // Estructura de decisión
        if($existe==1){
            // Modifico el mensaje y volvemos al formulario
            header("Location: especialista.php?mensaje=uno");
        }
        else{
    
            // El usuario no existe, permitimos la carga.
            $alta = "insert into especialista values(NULL,'$nombre','$apellido','$matricula','$consultorioSalaEspacio','$espacio')";
            $resultado_alta = mysqli_query($conexion,$alta);

            // Redirigimos al usuario
            header("Location: especialista.php");
        }
    }

    
?>