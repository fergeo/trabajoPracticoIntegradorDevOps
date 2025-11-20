<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/diaTurno.css">

    <?php
        require("../../../inc/conexion.php");
        
        $date = new DateTime();
        $fecha = $date->format('d/m/Y');
        
        $mensaje = 'Ingrese los datos';
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje']=='uno'){$mensaje = 'El turno ya existe en la base';}
        }

        $dniPaciente = 'TODOS';
        if(isset($_GET['dniPaciente'])){
            $dniPaciente = $_GET['dniPaciente'];
        }
        
    ?>

    <title>Escoger Dia Turno</title>
    
</head>
<body>



    <main class="contenedor-principal">
        <h1 class="title"> Paciente a ser Atendido en Consultorios Externos </h1>

        <form action="guardarDNI.php" method="post" class="formulario-insumo">
            <div class="inputs">
            <input type="text" id="fechaParam" name="fechaParam" style="visibility:collapse; display:none;" value=<?php echo $fecha ?>>

                <label for="dniPaciente" class="label-input">Numero de Documento:</label>
                <input type="text" id="dniPaciente" name="dniPaciente" placeholder="D.N.I." value=<?php echo $dniPaciente ?> >
            </div>  

            <div class="botones">
                <button button type="submit" class="btn-dni-gurdar">Buscar Paciente</button>
            </div>
        </form>

        <h1 class="title"> Turnos Reservados </h1>

        <table class="tables-turno">
            <thead class="table-headers">
            <tr>
                <td style="visibility:collapse; display:none;"></td><td>Fecha</td><td>Hora</td><td>DNI Paciente</td><td>Especialista</td><td>Espacio</td><td>Costo</td><td>Acciones</td>
            </tr>
            </thead>
            <tbody class="table-success">
                <?php
                    $consultaT = "select distinct 
                                    idReservaTurno,
                                    t.idTurno as idTurno,
                                    numDocumentoPaciente,
                                    diaTurno,
                                    horaTurno,
                                    nombreEspecialista,
                                    apellidoEspecialista,
                                    e.consultorioSalaEstudio as espascioConsultorioSala,
                                    consultorioNombre,
                                    montoFinal
                                from turno t,
                                    reservaturno r,
                                    paciente p,
                                    especialista e,
                                    consultorio c
                                where (e.consultorioSalaEstudio = 'Consultorio' and espacioEspecialista = idConsultorio)
                                        and t.idEspecialista = e.idEspecialista
                                        and r.idTurno = t.idTurno
                                        and r.idPaciente = p.idPaciente
                                        and estado = 'Ingresado'
                                        and diaTurno = '$fecha'";

                    //echo "<scrip>alert('$consultaT')</scrip>";                                        
                    $resultadoT = mysqli_query($conexion,$consultaT);

                    while($fila=mysqli_fetch_array($resultadoT)){
                            echo "<tr>";
                            echo '<td style="display:none;" id="idTurno">'.$fila['idReservaTurno']."</td>";
                            echo "<td>".$fila['diaTurno']."</td>";
                            echo "<td>".$fila['horaTurno']."</td>";
                            echo "<td>".$fila['numDocumentoPaciente']."</td>";
                            echo "<td>".$fila['nombreEspecialista']." ".$fila['apellidoEspecialista']."</td>";

                            // Mostrar los datos
                            if($fila['espascioConsultorioSala'] == 'Consultorio'){ 
                                echo "<td>" . $fila['espascioConsultorioSala'] . " - " . $fila['consultorioNombre'] . "</td>"; 
                            } 
                            else {
                                echo "<td>No se encontró el consultorio.</td>";
                            }
                    
                            echo "<td>".$fila['montoFinal']."</td>";
                            echo "<td>
                                <a href='cambia_estadoReservaTurno_sql.php?idReservaTurno=".$fila['idReservaTurno']."' 
                                    style='text-decoration:none'>
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
            <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/recepcionista/cambiarEstado/cambiarEstado.php">Volver</a></button> <br><br><br>
        </div>
    </main>

</body>
</html>