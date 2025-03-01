<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    El código de un taller. Se debe mostrar todos los datos de las reparaciones de
    ese taller han requerido garantía.<br><br>

    Equivalente a: <br><br>

    El código de un artista. Se debe mostrar todos los datos de las canciones de
    ese artista que han la sido inspiracion de otra cancion.<br><br>
</p>


<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_artista" class="form-label">Codigo artista</label>
            <input type="number" class="form-control" id="codigo_artista" name="codigo_artista" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $codigo_artista = $_POST["codigo_artista"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT  C1.CODIGO, C1.TITULO, C1.FECHA_LANZAMIENTO, C1.DURACION, C1.CODIGO_ALBUM
                FROM CANCION C1
                JOIN CANCION C2 ON C1.CODIGO = C2.CODIGO_INSPIRACION
                JOIN ALBUM ON C1.CODIGO_ALBUM = ALBUM.CODIGO
                JOIN ARTISTA  ON ALBUM.CODIGO_ARTISTA = ARTISTA.CODIGO
                WHERE ARTISTA.CODIGO = '$codigo_artista'";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Título</th>
                <th scope="col" class="text-center">Fecha de lanzamiento</th>
                <th scope="col" class="text-center">Duración</th>
                <th scope="col" class="text-center">Código del Album</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["TITULO"]; ?></td>
                <td class="text-center"><?= date("d/m/Y", strtotime($fila["FECHA_LANZAMIENTO"])); ?></td>
                <td class="text-center"><?= $fila["DURACION"]; ?> segundos</td>
                <td class="text-center"><?= $fila["CODIGO_ALBUM"]; ?></td>
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
endif;

include "../includes/footer.php";
?>