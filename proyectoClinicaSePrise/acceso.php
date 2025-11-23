<?php
// Inicia la sesión al principio del archivo
session_start();

// Conexión al servidor de BDD
include('inc/conexion.php');

// Tomo los datos del formulario
$perfil = $_POST['perfil'];    
$usuario = $_POST['usuario'];
$password = $_POST['password']; // CORRECCIÓN: typo $passowrd -> $password

// Asigna un valor a una variable de sesión
$_SESSION['usuario'] = $usuario;

// Verificamos si existe el usuario
$consulta = "SELECT COUNT(*) AS nuevo 
             FROM usuario 
             WHERE usuario = '$usuario' 
             AND password = '$password' 
             AND perfil = '$perfil'";
$resultado = mysqli_query($conexion, $consulta);

$a = mysqli_fetch_assoc($resultado);
$existe = $a['nuevo'] ?? 0; // Si no existe, asigna 0

// Redirección según perfil
if($existe == 1){
    switch($perfil){
        case "Administrador":
            header("Location: http://localhost/proyectoClinicaSePrise/administracion/main-adm.php");
            exit();
        case "Paciente":
            header("Location: http://localhost/proyectoClinicaSePrise/paciente/main-paciente.php");
            exit();
        case "Recepcionista":
            header("Location: http://localhost/proyectoClinicaSePrise/recepcionista/main-recepcionista.php");
            exit();
        case "Doctor":
            header("Location: http://localhost/proyectoClinicaSePrise/doctor/main-doctor.php");
            exit();
        default:
            header("Location: http://localhost/proyectoClinicaSePrise/");
            exit();
    }
} else {
    // Usuario no existe, redirige al login
    header("Location: http://localhost/proyectoClinicaSePrise/");
    exit();
}
?>
