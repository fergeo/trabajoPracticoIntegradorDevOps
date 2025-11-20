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

    <title>Panel Paciente</title>
</head>
<body>

    <main class="modulos">
        <div class="imagen-modulo">
            <img class="administracion" src="./assets/menu-paciente.jpg" alt="Administración">
        </div>
        <div class="botones-modulos">
            <button class="btn-registrar"><a href="registro/regisro.php">Registrarse</a></button>
            <button class="btn-historiaClinica"><a href="historiaClinica/historiaClinica.php">Consultar Historia Clinica</a></button>
            <button class="btn-registrarReserva"><a href="reservaTurno/reservaTurno.php">Registrar Reserva de Turno</a></button>
        </div>
    </main>

</body>
</html>