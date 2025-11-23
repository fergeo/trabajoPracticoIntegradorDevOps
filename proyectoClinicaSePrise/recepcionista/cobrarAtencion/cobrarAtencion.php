<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/diaTurno.css">

    <?php
        require("../../inc/conexion.php");
        
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

    <title>Cobrar Atencion</title>
    
</head>
<body>



    <main class="contenedor-principal">
        <h1 class="title"> Cobrar Atencion </h1>

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

        <h1 class="title"> Consultas o Estudios </h1>

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
                                    espacioEspecialista,
                                    e.consultorioSalaEstudio as consultorioSalaEstudio,
                                    montoFinal
                                from turno t,
                                    reservaturno r,
                                    paciente p,
                                    especialista e
                                where t.idEspecialista = e.idEspecialista
                                    and r.idTurno = t.idTurno
                                    and r.idPaciente = p.idPaciente
                                    and estado = 'Atendido'
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

                            $idReservaTurno = $fila['idReservaTurno'];
                            $monotFinal = $fila['montoFinal'];
                            $espacioEspecialista = $fila['espacioEspecialista'];
                            $espacio = $fila['consultorioSalaEstudio'];

                            if($fila['consultorioSalaEstudio'] == 'Consultorio'){ 
                                $consultaC = "select distinct 
                                            consultorioNombre
                                            from consultorio
                                    where  idConsultorio = '$espacioEspecialista'";
                                $resultadoC = mysqli_query($conexion,$consultaC);
                                while($fila=mysqli_fetch_array($resultadoC)){
                                    echo "<td>" . $espacio . " - " . $fila['consultorioNombre'] . "</td>"; 
                                } 
                            }
                            else if($fila['consultorioSalaEstudio'] == 'Sala de Estudios'){
                                $consultaS = "select distinct 
                                            salaEstudioNombre
                                            from salaestudio
                                    where  idSalaEstudio = '$espacioEspecialista'";
                                $resultadoS = mysqli_query($conexion,$consultaS);
                                while($fila=mysqli_fetch_array($resultadoC)){
                                    echo "<td>" . $espacio . " - " . $fila['salaEstudioNombre'] . "</td>"; 
                                } 
                            }
                            else{
                                echo "Datos no encontrados.";
                            }
                            
                            echo "<td>".$monotFinal."</td>";
                            echo "<td>
                                    <a href='pagarAtencion/pagar-atencion.php?idReservaTurno=".$idReservaTurno."'>
                                        Cobrar
                                    </a>
                                </td>";
                            echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="volver">
            <button class="btn-volver"><a href="http://localhost/proyectoClinicaSePrise/recepcionista/main-recepcionista.php">Volver</a></button> <br><br><br>
        </div>
    </main>

</body>
</html>