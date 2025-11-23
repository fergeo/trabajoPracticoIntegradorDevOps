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
            if($_GET['mensaje']=='uno'){$mensaje = 'El insumo ya existe en la base';}
        }
    ?>

    <title>Insumo</title>
</head>
<body>

    <?php
        require("../../inc/cabecera.php");
        cabecera();

        require("../../../inc/conexion.php");
        
        $consulta = "select distinct * from insumo";
        $resultado = mysqli_query($conexion,$consulta);
    ?>

    <main class="modulos">

        <div class="titulo-insumo">
            <p class="titulo-insumo-text">Insumos</p>
        </div>    

        <form action="alta_insumo_sql.php" method="post" class="formulario-insumo">
            <div class="inputs">
                <label for="nombre" class="label-input">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="inputs">
                <label for="nombre" class="label-input">Descripcion:</label>                
                <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion">
            </div>
            <div class="inputs">
                <label for="nombre" class="label-input">Cantidad:</label>      
                <input type="text" id="cantidad" name="cantidad" placeholder="cantidad Inicial">
            </div>
            <div class="botones">
                <button button type="submit" class="btn-add">Agregar</button>
                <button button type="submit" class="btn-add" class="button-modificar" id="button-modificar">Modificar</button>
            </div>
            <?php echo $mensaje; ?>   
        </form>

        <table class="tables-insumos">
            <thead class="table-headers">
                <tr>
                    <td style="visibility:collapse; display:none;"></td><td>Nombre</td><td>Descripcion</td><td>Cantidad</td><td>Cantidad en Stock</td><td>Acciones</td>
                </tr>
            </thead>
            <tbody class="table-success">
                <?php
                    while($fila=mysqli_fetch_array($resultado)){
                        echo "<tr>";
                        echo '<td style="visibility:collapse; display:none;" id="idInsumoTabla">'.$fila['idInsumo']."</td>";
                        echo '<td  id="nombreTabla">'.$fila['nombre']."</td>";
                        echo "<td>".$fila['descripcion']."</td>";
                        echo "<td>".$fila['cantidad']."</td>";
                        echo "<td>".$fila['cantidadStock']."</td>";
                        echo "<td>
                                <a id='modificar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                            <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                        </svg>
                                </a>
                                <a href='baja_insumo_sql.php?idInsumo=".$fila['idInsumo']."' 
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
            <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/administracion/main-adm.php">Volver</a></button>
        </div>

    </main>
</body>
</html>