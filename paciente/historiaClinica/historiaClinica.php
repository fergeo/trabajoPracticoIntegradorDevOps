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

            $consulta = "select distinct * from paciente where numDocumentoPaciente = $usuario";
            $resultado = mysqli_query($conexion,$consulta);
        }    
        
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
            <p class="titulo-insumo-text">Historia Clinica</p>
        </div>    

        <!-- Datos del Paciente -->
        <?php
            while($fila=mysqli_fetch_array($resultado)){
                echo "<div class='texto'>";
                    echo '<p> Numero de Documento: '.$fila['numDocumentoPaciente']."</p>";
                    echo '<p> Nombre: '.$fila['nombrePaciente']."</p>";
                    echo "<p> Apellido: ".$fila['apellidoPaciente']."</p>";
                    echo '<p> Domicilio: '.$fila['domicilioPaciente']."</p>";
                    echo '<p> E-mail: '.$fila['mailPaciente']."</p>";
                    echo '<p> Telefono:'.$fila['telefonoPaciente']."</p>";
                echo "<div>";    
            }
        ?>

        <div class="consultorios">
            <h2 class="sutitle">Turnos en Consultorios</h2>
            <table class="tables-turno">
            <thead class="table-headers">
            <tr>
                <td style="visibility:collapse; display:none;"></td><td>Fecha</td><td>Hora</td><td>Especialista</td><td>Espacio</td><td>Costo</td><td>Estado</td>
            </tr>
            </thead>
            <tbody class="table-success">
                <?php
                    $consultaT = "select distinct 
                                idReservaTurno,
                                t.idTurno as idTurno,
                                diaTurno,
                                horaTurno,
                                nombreEspecialista,
                                apellidoEspecialista,
                                e.consultorioSalaEstudio as espascioConsultorioSala,
                                consultorioNombre,
                                montoFinal,
                                estado
                            from turno t,
                                reservaturno r,
                                paciente p,
                                especialista e,
                                consultorio c
                            where (e.consultorioSalaEstudio = 'Consultorio' and espacioEspecialista = idConsultorio)
                            and t.idEspecialista = e.idEspecialista
                            and r.idTurno = t.idTurno
                            and r.idPaciente = p.idPaciente
                            and numDocumentoPaciente = '$usuario'";
                    $resultadoT = mysqli_query($conexion,$consultaT);

                    while($fila=mysqli_fetch_array($resultadoT)){
                            echo "<tr>";
                            echo '<td style="display:none;" id="idTurno">'.$fila['idTurno']."</td>";
                            echo "<td>".$fila['diaTurno']."</td>";
                            echo "<td>".$fila['horaTurno']."</td>";
                            echo "<td>".$fila['nombreEspecialista']." ".$fila['apellidoEspecialista']."</td>";

                            // Mostrar los datos
                            if($fila['espascioConsultorioSala'] == 'Consultorio'){ 
                                echo "<td>" . $fila['espascioConsultorioSala'] . " - " . $fila['consultorioNombre'] . "</td>"; 
                            } 
                            else {
                                echo "<td>No se encontró el consultorio.</td>";
                            }
                    
                            echo "<td>".$fila['montoFinal']."</td>";
                            echo "<td>".$fila['estado']."</td>";
                            echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>

        <div class="estudios">
            <h2 class="sutitle">Turnos para Estudios</h2>
            <table class="tables-turno">
            <thead class="table-headers">
            <tr>
                <td style="visibility:collapse; display:none;"></td><td>Fecha</td><td>Hora</td><td>Especialista</td><td>Espacio</td><td>Costo</td><td>Estado</td>
            </tr>
            </thead>
            <tbody class="table-success">
                <?php
                    $consultaT = "select distinct 
                                idReservaTurno,
                                t.idTurno as idTurno,
                                diaTurno,
                                horaTurno,
                                nombreEspecialista,
                                apellidoEspecialista,
                                e.consultorioSalaEstudio as espascioConsultorioSala,
                                salaEstudioNombre,
                                montoFinal,
                                estado
                            from turno t,
                                reservaturno r,
                                paciente p,
                                especialista e,
                                salaestudio s
                            where (e.consultorioSalaEstudio = 'Sala de Estudios' and espacioEspecialista = idSalaEstudio)
                            and t.idEspecialista = e.idEspecialista
                            and r.idTurno = t.idTurno
                            and r.idPaciente = p.idPaciente
                            and numDocumentoPaciente = '$usuario'";
                    $resultadoT = mysqli_query($conexion,$consultaT);

                    while($fila=mysqli_fetch_array($resultadoT)){
                            echo "<tr>";
                            echo '<td style="display:none;" id="idTurno">'.$fila['idTurno']."</td>";
                            echo "<td>".$fila['diaTurno']."</td>";
                            echo "<td>".$fila['horaTurno']."</td>";
                            echo "<td>".$fila['nombreEspecialista']." ".$fila['apellidoEspecialista']."</td>";

                            // Mostrar los datos
                            if($fila['espascioConsultorioSala'] == 'Consultorio'){ 
                                echo "<td>" . $fila['espascioConsultorioSala'] . " - " . $fila['consultorioNombre'] . "</td>"; 
                            } 
                            else {
                                echo "<td>No se encontró el consultorio.</td>";
                            }
                    
                            echo "<td>".$fila['montoFinal']."</td>";
                            echo "<td>".$fila['estado']."</td>";
                            echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>

        <div class="volver">
        <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/paciente/main-paciente.php">Volver</a></button>
        </div>

    </main>
</body>
</html>