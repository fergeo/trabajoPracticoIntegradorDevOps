<?php
    
    $idInsumo = $_GET['idInsumo'];
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];
    $cantidad = $_GET['cantidad'];
    $cantidadStock = $_GET['cantidad'];

    //echo "<script>alert('alert mensaje $descripcion')</script>";

    document.getElementById("nombre").innerHTML = <?php echo $nombre;

?>


