<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="css/style.css">

    <title>Cobrar Atencion</title>

    <?php
        require("../../../inc/conexion.php");
        $idReservaTurno = $_GET['idReservaTurno'];
    ?>
    
</head>
<body>

    <main class="contenedor-principal">

        <div class="titulo">
            <h1 class="title"> Cobrar Atención </h1>
        </div>

        <div class="detalle">
            <?php
                    $consultaT = "select distinct 
                                    idReservaTurno,
                                    t.idTurno as idTurno,
                                    numDocumentoPaciente,
                                    diaTurno,
                                    horaTurno,
                                    nombreEspecialista,
                                    apellidoEspecialista,
                                    e.consultorioSalaEstudio as consultorioSalaEstudio,
                                    espacioEspecialista,
                                    montoFinal
                                from turno t,
                                    reservaturno r,
                                    paciente p,
                                    especialista e
                                where  t.idEspecialista = e.idEspecialista
                                    and r.idTurno = t.idTurno
                                    and r.idPaciente = p.idPaciente
                                    and estado = 'Atendido'
                                    and idReservaTurno = '$idReservaTurno'";
                                        
                    //echo "<scrip>alert('$consultaT')</scrip>";                                        
                    $resultadoT = mysqli_query($conexion,$consultaT);

                    while($fila=mysqli_fetch_array($resultadoT)){
                            $diaTurno = $fila['diaTurno'];
                            $horaTurno = $fila['horaTurno'];
                            $numDocumentoPaciente = $fila['numDocumentoPaciente'];
                            $nombreEspecialista = $fila['nombreEspecialista'];
                            $apellidoEspecialista = $fila['apellidoEspecialista'];
                            $costo = $fila['montoFinal'];

                            echo "<p>Dia: $diaTurno</p>";
                            echo "<p>Hora: $diaTurno</p>";
                            echo "<p>Nro. DNI Paciente: $diaTurno</p>";
                            echo "<p>Especialista: $nombreEspecialista $apellidoEspecialista";
                            
                            $espacioEspecialista = $fila['espacioEspecialista'];
                            $espacio = $fila['consultorioSalaEstudio'];

                            if($fila['consultorioSalaEstudio'] == 'Consultorio'){ 
                                $consultaC = "select distinct 
                                            consultorioNombre
                                            from consultorio
                                    where  idConsultorio = '$espacioEspecialista'";
                                $resultadoC = mysqli_query($conexion,$consultaC);
                                while($fila=mysqli_fetch_array($resultadoC)){
                                    $lugarNombre = $fila['consultorioNombre']; 
                                } 
                            }
                            else if($fila['consultorioSalaEstudio'] == 'Sala de Estudios'){
                                $consultaS = "select distinct 
                                            salaEstudioNombre
                                            from salaestudio
                                    where  idSalaEstudio = '$espacioEspecialista'";
                                $resultadoS = mysqli_query($conexion,$consultaS);
                                while($fila=mysqli_fetch_array($resultadoC)){
                                    $lugarNombre = $fila['salaEstudioNombre']; 
                                } 
                            }
                            else{
                                echo "Datos no encontrados.";
                            }
                            
                            echo "<p>Espacio: $espacio - $lugarNombre</p>";
                            echo "<p>Costo: $costo</p>";
                        }
                ?>
        </div>

        <div class="formulario">
            <form action="cambiar_estado_reservaTurno_sql.php".$idReservaTurno method="post" class="formulario-insumo">
                <div class="inputs">
                    <input type="text" id="idReservaTurno" name="idReservaTurno"  style="display:none;" value=<?php echo $idReservaTurno ?> >
                </div>  

                <div class="inputs">
                    <input type="text" id="costo" name="costo"  style="display:none;" value=<?php echo $costo ?> >
                </div>  
                <div class="inputs">
                    <label for="formaPago">Forma de Pago:</label>
                    <select id="formaPago" name="formaPago">
                        <option value="efectivo">Efectivo</option>
                        <option value="credito">Tarjeta de Crédito</option>
                        <option value="debito">Tarjeta de Débito</option>
                    </select>
                </div>  

                <div class="botones">
                    <label for="cuota">Cuotas:</label>
                    <select id="cuota" name="cuota">
                        <option value="1">1</option>
                        <option value="3">3</option>
                        <option value="6">6</option>
                    </select>
                </div>

                <button class="btn-pagar" type="submit">Cobrar Atención</button>
            </form>
        </div>
    </main>

</body>
</html>