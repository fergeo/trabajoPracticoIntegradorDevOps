<?php
    // Conexión al servidor de BDD
    include('inc/conexion.php');
    
    // Tomo los datos del formulario
    $perfil = $_POST['perfil'];    
    $usuario = $_POST['usuario'];
    $passowrd = $_POST['password'];

    session_start();
    // Asigna un valor a una variable de sesión
    $_SESSION['usuario'] = $_POST['usuario'];

     // Verificamos si existe el usuario.
    $consulta = "select count(distinct usuario) as nuevo from usuario where usuario = '$usuario' and password = '$passowrd' and perfil = '$perfil' ";
    $resultado = mysqli_query($conexion,$consulta);

    while($a = mysqli_fetch_assoc($resultado)){
        $existe = $a['nuevo'];
    }

    //echo "<script>alert('enetro valor $existe $perfil');</script>";

    // Estructura de decisión
    if($existe==1){
        echo "<script>alert('entrodd');</script>";

        if($perfil == "Administrador")
            header("Location:http://localhost/proyectoClinicaSePrise/administracion/main-adm.php");
        else if($perfil == "Paciente"){
            echo "<script>alert('entro1');</script>";
            header("Location:http://localhost/proyectoClinicaSePrise/paciente/main-paciente.php");
        }
        else if($perfil == "Recepcionista"){
            echo "<script>alert('entro1');</script>";
            header("Location:http://localhost/proyectoClinicaSePrise/recepcionista/main-recepcionista.php");
        }
        else if($perfil == "Doctor"){
            echo "<script>alert('entro1');</script>";
            header("Location:http://localhost/proyectoClinicaSePrise/doctor/main-doctor.php");
        }
        else{
            header("Location:http://localhost/proyectoClinicaSePrise?");
        }
            
        
    }
    else{
        header("Location:http://localhost/proyectoClinicaSePrise?");
    }   

?>