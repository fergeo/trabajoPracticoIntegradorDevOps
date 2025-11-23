<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Panel Administración</title>
</head>
<body>

    <?php
        require("inc/cabecera.php");
        cabecera();
    ?>

    <main class="modulos">
        <div class="imagen-modulo">
            <img class="administracion" src="./assets/administracion.jpg" alt="Administración">
        </div>
        <div class="botones-modulos">
            <button id="insumo"><a href="modulos/insumo/insumo.php">Gestionar Insumo</a></button>
            <button id="consultorio"><a href="modulos/consultorio/consultorio.php">Gestionar Consultorio</a></button>
            <button id="salaEstudio"><a href="modulos/salaEstudio/salaestudio.php">Gestionar Sala de Esudio</a></button>
            <button id="especialista"><a href="modulos/especialista/especialista.php">Gestionar Especialista</a></button>
            <button id="turno"><a href="modulos/turno/turno.php">Gestionar Turno</a></button>
        </div>
    </main>

</body>
</html>