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
            <img class="administracion" src="./assets/administracion.jpg" alt="Administración">
        </div>
        <div class="botones-modulos">
            <button class="btn-registrar"><a href="registro/regisro.php">Registrar Paciente</a></button>
            <button class="btn-reservar"><a href="reservaTurno/reservaTurno.php">Registrar Reserva de Turno</a></button>
            <button class="btn-cambiarEstado"><a href="cambiarEstado/cambiarEstado.php">Paciente a ser Atendido</a></button>
            <button class="btn-cobarAtencion"><a href="cobrarAtencion/cobrarAtencion.php">Cobrar Consulta o Estudio</a></button>
            
        </div>
    </main>

</body>
</html>