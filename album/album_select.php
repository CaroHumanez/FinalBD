<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD
//$query = "SELECT * FROM album";

$query = "SELECT ALBUM.CODIGO, ALBUM.TITULO, ALBUM.ANO_LANZAMIENTO, ALBUM.CREDITOS, ALBUM.CODIGO_ARTISTA,
                 ARTISTA.NOMBRE_ARTISTICO 
          FROM ALBUM
          JOIN ARTISTA ON ALBUM.CODIGO_ARTISTA = ARTISTA.CODIGO
          ORDER BY ALBUM.CODIGO";

// Ejecutar la consulta
$resultadoAlbum = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);