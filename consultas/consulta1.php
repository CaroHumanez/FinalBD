<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
        Mostrar los datos de las tres reparaciones de mayor valor junto con 
        los datos de los mecánicos asociados a cada una de estas reparaciones.<br><br>

        Equivalente a:<br><br>

        Mostrar los datos de las tres canciones de mayor duracion con 
        los datos de los albumes asociados a cada una de las canciones. En caso de empate<br> 
        por la duracion se organiza por la fecha de forma asendente.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');


// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT 
        CANCION.*, 
        ALBUM.*,
        ALBUM.TITULO AS NOMBRE_ALBUM, 
        ARTISTA.NOMBRE_ARTISTICO AS ARTISTA
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

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cod canción</th>
                <th scope="col" class="text-center">Canción</th>
                <th scope="col" class="text-center">Fecha<br>Lanzamiento</th>
                <th scope="col" class="text-center">Duración</th>
                <th scope="col" class="text-center">Artista</th>
                <th scope="col" class="text-center">Cod Album</th>
                <th scope="col" class="text-center">Álbum</th>
                <th scope="col" class="text-center">Créditos</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["TITULO"]; ?></td>
                <td class="text-center"><?= date("d/m/Y", strtotime($fila["FECHA_LANZAMIENTO"])); ?></td>
                <td class="text-center table-danger"><?= $fila["DURACION"]; ?> min</td>
                <td class="text-center"><?= $fila["ARTISTA"]; ?></td>
                <td class="text-center"><?= $fila["CODIGO_ALBUM"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_ALBUM"]; ?></td>
                <td class="text-center"><?= $fila["CREDITOS"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
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