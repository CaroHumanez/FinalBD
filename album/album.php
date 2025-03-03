<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECÁNICO (ÁLBUM)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="album_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Título</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <!-- Consultar la lista de artistas y desplegarlos -->
        <div class="mb-3">
            <label for="artista" class="form-label">Artista</label>
            <select name="artista" id="artista" class="form-select" required>
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../artista/artista_select.php");
                
                // Verificar si llegan datos
                if($resultadoArtista):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoArtista as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["CODIGO"]; ?>"><?= $fila["NOMBRE_ARTISTICO"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año de lanzamiento</label>
            <input type="number" class="form-control" id="anio" name="anio" required>
        </div>

        <div class="mb-3">
            <label for="creditos" class="form-label">Créditos(URL)</label>
            <input type="text" class="form-control" id="creditos" name="creditos" required>
        </div>
        

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("album_select.php");

// Verificar si llegan datos
if($resultadoAlbum and $resultadoAlbum->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Título</th>
                <th scope="col" class="text-center">Artista</th>
                <th scope="col" class="text-center">Año de lanzamiento</th>
                <th scope="col" class="text-center">Créditos</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoAlbum as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["TITULO"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_ARTISTICO"]; ?></td>
                <td class="text-center"><?= $fila["ANO_LANZAMIENTO"]; ?></td>
                <td class="text-center"><?= $fila["CREDITOS"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="album_delete.php" method="post">
                        <input hidden type="text" name="codigo" value="<?= $fila["CODIGO"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>