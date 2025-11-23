<?php
/******************************************************************************
 * Archivo: conexion.php
 * Proyecto: ClinicaSePrise
 * Función: Establecer la conexión a la base de datos MySQL
 * Autor: Fernando Espindola
 ******************************************************************************/

// PASO 1) Datos de conexión a la base de datos
$usuario = 'root';                     // Usuario de la base de datos
$clave = 'root';                        // Contraseña del usuario
$servidor = 'mysql';                    // Nombre del servicio MySQL en docker-compose
$basededatos = 'clinicaMedicaSePrise'; // Nombre de la base de datos

// PASO 2) Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $clave, $basededatos);

// PASO 3) Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Opcional: mostrar mensaje de éxito para debug
// echo "Conexión a la base de datos exitosa.";

?>
