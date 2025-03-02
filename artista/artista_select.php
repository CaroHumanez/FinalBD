<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD
$query = "SELECT * FROM artista
            ORDER BY ARTISTA.CODIGO";

// Ejecutar la consulta
$resultadoArtista = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);