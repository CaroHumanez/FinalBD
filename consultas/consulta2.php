<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 2</h1>

<p class="mt-3">
    Mostrar el código y el nombre de los talleres de los dos talleres que tienen la mayor cantidad<br>
    de reparaciones (en caso de empates,usted decide cómo proceder).<br><br>

    Equivalente a:<br><br>

    Mostrar el código y el nombre artistico de los dos artistas que tiene la mayor cantidad de canciones<br>
    en caso de empates, se decide por el nombre alfabeticamente .
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT ARTISTA.CODIGO,ARTISTA.NOMBRE_ARTISTICO, COUNT(CANCION.CODIGO) AS TOTAL_CANCIONES FROM ARTISTA
JOIN 
ALBUM ON ARTISTA.CODIGO = ALBUM.CODIGO_ARTISTA
JOIN
CANCION ON CANCION.CODIGO_ALBUM = ALBUM.CODIGO
GROUP BY ARTISTA.CODIGO
ORDER BY TOTAL_CANCIONES DESC, ARTISTA.NOMBRE_ARTISTICO ASC
LIMIT 2;";

// Ejecutar la consulta
$resultadoC2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC2 and $resultadoC2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Codigo</th>
                <th scope="col" class="text-center">Nombre Artistico</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_ARTISTICO"]; ?></td>
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