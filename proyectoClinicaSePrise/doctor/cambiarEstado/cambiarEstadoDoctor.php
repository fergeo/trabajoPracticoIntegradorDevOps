<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reservaturno.css">

    <?php
        require("../inc/cabecera.php");
        cabecera();
    ?>

    <title>Paciente en Sala</title>
</head>
<body>

    <main class="modulos">
        <div class="imagen-modulo">
            <img class="administracion" src="./assets/administracion.jpg" alt="Administración">
        </div>
        <div class="botones-modulos">
            <h1 class="title">Registrar Atencion a Paciente</h1>
            
            <button class="btn-historiaClinica"><a href="http://localhost/proyectoClinicaSePrise/doctor/cambiarEstado/consultorios/cambiaEstadoDoctorObs.php">Consultorios Externos</a></button>
            <button class="btn-registrarReserva"><a href="http://localhost/proyectoClinicaSePrise/doctor/cambiarEstado/estudios/cambiaEstadoDoctorObs.php">Estudios</a></button>
            
            <button class="btn-registrarReserva"><a href="http://localhost/proyectoClinicaSePrise/doctor/main-doctor.php">Voler</a></button>
        </div>
        
    </main>

</body>
</html>