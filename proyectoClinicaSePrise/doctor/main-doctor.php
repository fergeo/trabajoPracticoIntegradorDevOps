<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <?php
        require("inc/cabecera.php");
        cabecera();
    ?>

    <title>Panel Doctor</title>
</head>
<body>

    <main class="modulos">
        <div class="imagen-modulo">
            <img class="administracion" src="./assets/atencion-paciente.jpg" alt="Atencion Paciente">
        </div>
        <div class="botones-modulos">
            <button class="btn-registrar"><a href="http://localhost/proyectoClinicaSePrise/doctor/cambiarEstado/cambiarEstadoDoctor.php">Atencion a Paciente</a></button>

            
            <!--<button class="btn-registrarReserva"><a href="reservaTurno/reservaTurno.php">Registrar Reserva de Turno</a></button>-->
            <!--<button class="btn-registrarReserva"><a href="cambiarEstado/cambiarEstado.php">Paciente a ser Atendido</a></button>-->
            <!--<button class="btn-registrarReserva"><a href="reservaTurno/reservaTurno.php">Cancelacion de Reserva de Turno</a></button>-->
            <!--<button class="btn-historiaClinica"><a href="historiaClinica/historiaClinica.php">Consultar Historia Clinica</a></button>-->
        </div>
    </main>

</body>
</html>