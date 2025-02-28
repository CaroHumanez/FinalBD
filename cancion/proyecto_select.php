<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD
$query = "SELECT 
    CANCION.CODIGO, 
    CANCION.TITULO, 
    CANCION.FECHA_LANZAMIENTO, 
    CANCION.DURACION, 
    CANCION.CODIGO_ALBUM, 
    CANCION.CODIGO_INSPIRACION,
    ALBUM.TITULO AS NOMBRE_ALBUM
        FROM CANCION
        JOIN ALBUM ON CANCION.CODIGO_ALBUM = ALBUM.CODIGO;";

// Ejecutar la consulta
$resultadoProyecto = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);