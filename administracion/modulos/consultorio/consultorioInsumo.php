<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/style.css">

    <?php
        require("../../../inc/conexion.php");
        
        // Sección mensaje.
        $mensaje = 'Ingrese los datos';
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje']=='uno'){$mensaje = 'Ya agrego ese insumo para el consultorio';}
        }
    ?>

    <title>Consultorio-Insumos</title>
</head>
<body>

    <?php
        require("../../inc/cabecera.php");
        cabecera();

        require("../../../inc/conexion.php");
        
        $consulta = "select distinct * from consultorioInsumo";
        $resultado = mysqli_query($conexion,$consulta);

        
        //if (isset($_GET['idConsultorio'])) {
            $idConsultorio = $_GET['idConsultorio'];

            $consulta0 = "select distinct consultorioNombre from consultorio where idConsultorio = $idConsultorio";
            $resultado0 = mysqli_query($conexion,$consulta0);
            $consultorio0 = mysqli_fetch_array($resultado0);
            $consultirio = $consultorio0[0];

        //}

    ?>

    <main class="modulos">

        <div class="titulo-insumo">
            <p class="titulo-insumo-text">Insumo para Consultorios</p>
        </div>    

        <form action="alta_consultorioInsumo_sql.php" method="post" class="formulario-insumo">
            <div class="inputs">
                <label for="consultorio" class="label-input">Insumo:</label>
            
                <?php
                    
                    echo "<input style='display:none;' name='idConsultorio' value='$idConsultorio'>";
                    
                    $consulta1 = "select distinct * from insumo";
                    $resultado1 = mysqli_query($conexion,$consulta1);

                    echo "<select name='idInsumo' id='insumo'>";
                    while($fila=mysqli_fetch_array($resultado1)){
                        echo "<option name='idInsumo' value=".$fila['idInsumo'].">".$fila['nombre']."</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            
            <div class="botones">
                <button button type="submit" class="btn-add">Agregar</button>
            </div>
            <?php echo $mensaje; ?>   
        </form>

        <table class="tables-insumos">
            <thead class="table-headers">
                <tr>
                    <td style="visibility:collapse; display:none;"></td><td>Consultorio</td><td>Insumos</td><td>Acciones</td>
                </tr>
            </thead>
            <tbody class="table-success">
                <?php
                    $consulta2 = "select distinct * from consultorioInsumo where idConsultorio = $idConsultorio";
                    $resultado2 = mysqli_query($conexion,$consulta2);

                    while($fila=mysqli_fetch_array($resultado2)){
                        echo "<tr>";
                        echo '<td  id="Consultorio">'.$consultirio."</td>";

                        $consulta1 = "select distinct * from insumo";
                        $resultado1 = mysqli_query($conexion,$consulta1);
                        
                        $idInsumo = $fila['idInsumo'];
                        $consulta3 = "select distinct nombre from insumo where idInsumo = $idInsumo";
                        $resultado3 = mysqli_query($conexion,$consulta3);
                        $insumo3 = mysqli_fetch_array($resultado3);
                        $insumo = $insumo3[0];

                        echo '<td  id="Consultorio">'.$insumo."</td>";
                        echo "<td>
                                <a href='baja_consultorioInsumo_sql.php?idConsultorio=$idConsultorio&idInsumo=$idInsumo
                                    style='text-decoration:none'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
                                        </svg>
                                </a>
                            </td>";
                        echo "</tr>";
                        }
                ?>
            </tbody>
        </table>

        <div class="volver">
            <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/administracion/modulos/consultorio/consultorio.php">Volver</a></button>
        </div>

    </main>
</body>
</html>