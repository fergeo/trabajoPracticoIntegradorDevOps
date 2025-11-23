<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="css/style.css">

    <title>Escoger Dia Turno</title>

    <?php

        $idReservaTurno = $_GET['idReservaTurno'];

    ?>
    
</head>
<body>

    <main class="contenedor-principal">

        <div class="titulo">
            <h1 class="title"> Observaciones de la Consulta </h1>
        </div>

        <div class="formulario">
            <form action="cambiar_estado_reservaTurno_sql.php".$idReservaTurno method="post" class="formulario-insumo">
                <div class="inputs">
                    <input type="text" id="idReservaTurno" name="idReservaTurno"  style="display:none;" value=<?php echo $idReservaTurno ?> >

                    <label for="observacion" class="label-input">Numero de Documento:</label>    
                    <textarea id="observacion" name="observacion" rows="10" cols="100" placeholder="Escribe las observaciones aquí..."></textarea>
                </div>  

                <div class="botones">
                    <button button type="submit" class="btn-cerrar">Cerrar consulta</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>