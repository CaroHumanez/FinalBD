<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACIÓN (CANCIÓN)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="cancion_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>

        <!-- Consultar la lista de albumes y desplegarlos -->
        <div class="mb-3">
            <label for="album" class="form-label">Álbum</label>
            <select name="album" id="album" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../album/album_select.php");
                
                // Verificar si llegan datos
                if($resultadoAlbum):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoAlbum as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["CODIGO"]; ?>"><?= $fila["CODIGO"]; ?> - <?= $fila["TITULO"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="fechalanzamiento" class="form-label">Fecha de lanzamiento</label>
            <input type="date" class="form-control" id="fechalanzamiento" name="fechalanzamiento" required>
        </div>

        <div class="mb-3">
            <label for="duracion" class="form-label">Duración</label>
            <input type="number" class="form-control" id="duracion" name="duracion" required>
        </div>

        <!-- Consultar la lista de empresas y desplegarlos -->
        <div class="mb-3">
            <label for="inspiracion" class="form-label">Inspiración</label>
            <select name="inspiracion" id="inspiracion" class="form-select">
                
                <!-- Option por defecto -->
                <option value="NULL" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../cancion/cancion_select.php");
                
                // Verificar si llegan datos
                if($resultadoCancion):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCancion as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["CODIGO"]; ?>"><?= $fila["CODIGO"]; ?> - <?= $fila["TITULO"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("cancion_select.php");
            
// Verificar si llegan datos
if($resultadoCancion and $resultadoCancion->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Título</th>
                <th scope="col" class="text-center">Álbum</th>
                <th scope="col" class="text-center">Fecha de lanzamiento</th>
                <th scope="col" class="text-center">Duracion</th>
                <th scope="col" class="text-center">Inspiración</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoCancion as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["TITULO"]; ?></td>
                <td class="text-center"><?= $fila["CODIGO_ALBUM"]; ?>-<?= $fila["NOMBRE_ALBUM"]; ?> </td>
                <td class="text-center"><?= date("d/m/Y", strtotime($fila["FECHA_LANZAMIENTO"])); ?></td>
                <td class="text-center"><?= $fila["DURACION"]; ?> segundos</td>
                <td class="text-center"><?= $fila["CODIGO_INSPIRACION"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="cancion_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["CODIGO"]; ?>">
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