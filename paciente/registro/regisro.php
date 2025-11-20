<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="css/style.css">

    <?php
        require("../../inc/conexion.php");

        //require("../../inc/cabecera.php");
        //cabecera();

        session_start();
        // Verifica si la variable de sesión existe antes de usarla
        if (isset($_SESSION['usuario'])) {
        // Recupera y muestra el valor de la variable de sesión
            $usuario = $_SESSION['usuario'];
        }    

        $consulta = "select distinct * from paciente where numDocumentoPaciente = $usuario";
        $resultado = mysqli_query($conexion,$consulta);
        
        // Sección mensaje.
        $mensaje = 'Ingrese los datos';
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje']=='uno'){$mensaje = 'El insumo ya existe en la base';}
        }
    ?>

    <title>Consultorio</title>
</head>
<body>

    <main class="modulos">

        <div class="titulo-insumo">
            <p class="titulo-insumo-text">Paciente</p>
        </div>    

        <!-- Ingreso de datos-->
        <form action="alta_paciente_sql.php" method="post" class="formulario-insumo">
            <div class="inputs">
                <label for="nroDoc" class="label-input">Numero de Documento:</label>
                <input type="text" id="nroDoc" name="nroDoc" value =<?php echo $usuario; ?> readonly>
            </div>
            <div class="inputs">
                <label for="nombre" class="label-input">Nombre:</label>      
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="inputs">
                <label for="apellido" class="label-input">Apellido:</label>      
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
            </div>
            <div class="inputs">
                <label for="domicilio" class="label-input">Domicilio:</label>      
                <input type="text" id="domicilio" name="domicilio" placeholder="Domicilio" required>
            </div>

            <div class="inputs">
                <input type="checkbox" id="poseeOS" name="poseeOS" value="1">
                <label for="poseeOS">Posee Obra Social?</label>
                <div class="obraSocial"></div>
            </div>
            
            <div class="inputs">
                <label for="email" class="label-input">E-mail:</label>      
                <input type="text" id="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="inputs">
                <label for="teleforno" class="label-input">Telefono:</label>      
                <input type="text" id="telefono" name="telefono" placeholder="Telefono" required>
            </div>
            <div class="botones">
                <button button type="submit" class="btn-add">Agregar</button>
                <button button type="submit" class="btn-add btn-modificar" class="button-modificar">Modificar</button>
            </div>
            <?php echo $mensaje; ?>   
        </form>

        <table class="tables-insumos">
            <thead class="table-headers">
                <tr>
                    <td style="visibility:collapse; display:none;"></td>
                    <td>Nro. Documento</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Obra Social</td>
                    <td>Domicilio</td>
                    <td>E-mail</td>
                    <td>Telefono</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody class="table-success">
                <?php
                    while($fila=mysqli_fetch_array($resultado)){
                        echo "<tr>";
                            echo '<td style="visibility:collapse; display:none;" id="idPaciente">'.$fila['idPaciente']."</td>";
                            echo '<td>'.$fila['numDocumentoPaciente']."</td>";
                            echo '<td>'.$fila['nombrePaciente']."</td>";
                            echo "<td>".$fila['apellidoPaciente']."</td>";

                            if($fila['poseeObraSocial']==1){
                                $valor = "SI";
                            }
                            else{
                                $valor = "NO";
                            }

                            echo '<td>'.$valor."</td>";
                            echo '<td>'.$fila['domicilioPaciente']."</td>";
                            echo '<td>'.$fila['mailPaciente']."</td>";
                            echo '<td>'.$fila['telefonoPaciente']."</td>";
                        
                            echo "<td>
                                    <a id='modificar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                            <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                        </svg>
                                    </a>
                                </td>";
                        echo "</tr>";
                        }
                ?>
            </tbody>
        </table>

        <div class="volver">
        <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/paciente/main-paciente.php">Volver</a></button>
        </div>

    </main>
</body>
</html>