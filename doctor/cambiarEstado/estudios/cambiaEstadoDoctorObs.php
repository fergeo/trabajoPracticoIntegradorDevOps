<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/diaTurno.css">

    <?php
        require("../../../inc/conexion.php");
        
        // Sección mensaje.
        $fecha = date("d/m/Y");
        
        $mensaje = 'Ingrese los datos';
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje']=='uno'){$mensaje = 'El turno ya existe en la base';}
        }

        session_start();
        // Verifica si la variable de sesión existe antes de usarla
        if (isset($_SESSION['usuario'])) {
        // Recupera y muestra el valor de la variable de sesión
            $matricula = $_SESSION['usuario'];
        }  

        if(strlen($fecha) == 9){
            $fecha = '0'.$fecha;
        }
        //echo "<scrip>aler('$fecha');</script>";
        
        $dniPaciente = 'TODOS';
        if(isset($_GET['dniPaciente'])){
            $dniPaciente = $_GET['dniPaciente'];
        }
        
    ?>

    <title>Escoger Dia Turno</title>
    
</head>
<body>



    <main class="contenedor-principal">
        <h1 class="title"> Pacientes a Realizarse Estudios </h1>

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

        <h1 class="title"> Consultas </h1>

        <table class="tables-turno">
            <thead class="table-headers">
            <tr>
                <td style="visibility:collapse; display:none;"></td><td>Fecha</td><td>Hora</td><td>DNI Paciente</td><td>Especialista</td><td>Espacio</td><td>Costo</td><td>Observación</td>
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
                                        and estado = 'En Espera'
                                        and diaTurno = '$fecha'
                                        and ('$dniPaciente' = 'TODOS' or numDocumentoPaciente = '$dniPaciente')";

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
                                    <a href='agregarObservacion/agregar-observacion.php?idReservaTurno=".$fila['idReservaTurno']."'>
                                        Observación
                                    </a>
                                </td>";
                            echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="volver">
            <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/doctor/cambiarEstado/cambiarEstadoDoctor.php">Cerrar Estudio</a></button> <br><br><br>
        </div>
    </main>

</body>
</html>