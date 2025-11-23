<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/elegirTurno.css">

    <?php
        require("generarJSON.php");
    ?>
    
    <title>Turnos</title>
</head>
<body>

    <?php
        //require("../../inc/cabecera.php");
        //cabecera();

        require("../../../inc/conexion.php");
    ?>

    <main class="contenedor-principal">
        <h1 class="title">Turnos</h1>

        <div class="turnos">
            <div class="imagen-turno">
                <img src="img/image.png" alt="Imagen turno">
            </div>

            <table id="calendar">
                <thead>
                    <caption> </caption>
                    <tr>
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Mie</th>
                        <th>Jue</th>
                        <th>Vie</th>
                        <th>Sab</th>
                        <th>Dom</th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
        </div>

        <div class="volver">
            <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/recepcionista/reservaTurno/reservaTurno.php">Volver</a></button> <br><br><br>
        </div>

    </main>

    <script src="js/script.js"></script>
</body>

</html>