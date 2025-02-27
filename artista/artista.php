<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a TALLER (ARTISTA)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="artista_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Codigo</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Genero Musical</label>
            <input type="text" class="form-control" id="genero" name="genero" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="Solista" selected>Solista</option>
                <option value="Grupo" >Grupo</option>
            </select>

        <div class="mb-3">
            <label for="genero" class="form-label">Nombre Real <strong> (Uso exclusivo Solista)</strong></label>
            <input type="text" class="form-control" id="nombre_oficial" name="nombre_oficial">
        </div>
        
        <div class="mb-3">
            <label for="genero" class="form-label">Numero Integrantes <strong>(Uso exclusivo Banda)</strong> </label>
            <input type="number" class="form-control" id="numero_integrantes" name="numero_integrantes">
        </div>

        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("artista_select.php");

// Verificar si llegan datos
if($resultadoArtista and $resultadoArtista->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
            <th scope="col" class="text-center">Codigo</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Genero</th>
                <th scope="col" class="text-center">NombreOficial</th>
                <th scope="col" class="text-center">Numero Integrantes</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoArtista as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_ARTISTICO"]; ?></td>
                <td class="text-center"><?= $fila["GENERO_MUSICAL"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_OFICIAL"]; ?></td>
                <td class="text-center"><?= $fila["NUMERO_INTEGRANTES"]; ?></td>
                <td class="text-center"><?= $fila["TIPO_ARTISTA"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="artista_delete.php" method="post">
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