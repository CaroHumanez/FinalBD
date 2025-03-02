<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    Mostrar los datos de las tres canciones de mayor duración con los datos de los álbumes asociados a cada una de las canciones. En caso de empate<br> 
    por la duración se organiza por la fecha de forma ascendente.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL corregida
$query = "SELECT 
        CANCION.CODIGO, 
        CANCION.TITULO AS NOMBRE_CANCION, 
        CANCION.FECHA_LANZAMIENTO, 
        CANCION.DURACION, 
        ALBUM.TITULO AS NOMBRE_ALBUM, 
        ARTISTA.NOMBRE_ARTISTICO AS ARTISTA,
        ALBUM.CREDITOS,
        CANCION.CODIGO_ALBUM
        FROM CANCION
        JOIN ALBUM ON CANCION.CODIGO_ALBUM = ALBUM.CODIGO
        JOIN ARTISTA ON ALBUM.CODIGO_ARTISTA = ARTISTA.CODIGO
        ORDER BY CANCION.DURACION DESC, CANCION.FECHA_LANZAMIENTO ASC
        LIMIT 3;";

// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cod canción</th>
                <th scope="col" class="text-center">Canción</th>
                <th scope="col" class="text-center">Fecha Lanzamiento</th>
                <th scope="col" class="text-center">Duración</th>
                <th scope="col" class="text-center">Artista</th>
                <th scope="col" class="text-center">Cod Álbum</th>
                <th scope="col" class="text-center">Álbum</th>
                <th scope="col" class="text-center">Créditos</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros obtenidos
            foreach ($resultadoC1 as $fila):
            ?>

            <tr>
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_CANCION"]; ?></td>
                <td class="text-center"><?= date("d/m/Y", strtotime($fila["FECHA_LANZAMIENTO"])); ?></td>
                <td class="text-center table-danger"><?= $fila["DURACION"]; ?> seg</td>
                <td class="text-center"><?= $fila["ARTISTA"]; ?></td>
                <td class="text-center"><?= $fila["CODIGO_ALBUM"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_ALBUM"]; ?></td>
                <td class="text-center"><?= $fila["CREDITOS"]; ?></td>
            </tr>

            <?php
            endforeach;
            ?>

        </tbody>
    </table>
</div>

<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>
