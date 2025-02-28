<?php
include "../includes/header.php";
?>

<h1 class="mt-3">Entidad análoga a TALLER (ARTISTA)</h1>

<div class="formulario p-4 m-3 border rounded-3">
    <form action="artista_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género Musical</label>
            <input type="text" class="form-control" id="genero" name="genero" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required onchange="toggleCampos()">
                <option value="Solista" selected>Solista</option>
                <option value="Grupo">Grupo</option>
            </select>
        </div>

        <div class="mb-3" id="campoNombreReal">
            <label for="nombre_oficial" class="form-label">Nombre Real</label>
            <input type="text" class="form-control" id="nombre_oficial" name="nombre_oficial">
        </div>

        <div class="mb-3" id="campoNumeroIntegrantes" style="display: none;">
            <label for="numero_integrantes" class="form-label">Número de Integrantes</label>
            <input type="number" class="form-control" id="numero_integrantes" name="numero_integrantes">
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<script>
function toggleCampos() {
    var tipo = document.getElementById("tipo").value;
    var campoNombreReal = document.getElementById("campoNombreReal");
    var campoNumeroIntegrantes = document.getElementById("campoNumeroIntegrantes");
    var inputNombreReal = document.getElementById("nombre_oficial");
    var inputNumeroIntegrantes = document.getElementById("numero_integrantes");

    if (tipo === "Solista") {
        campoNombreReal.style.display = "block";
        campoNumeroIntegrantes.style.display = "none";

        inputNombreReal.setAttribute("required", "true");
        inputNumeroIntegrantes.removeAttribute("required"); 
    } else {
        campoNombreReal.style.display = "none";
        campoNumeroIntegrantes.style.display = "block";

        inputNumeroIntegrantes.setAttribute("required", "true");
        inputNombreReal.removeAttribute("required");
    }
}

document.addEventListener("DOMContentLoaded", toggleCampos);
</script>

<?php
require("artista_select.php");

if ($resultadoArtista && $resultadoArtista->num_rows > 0):
?>

<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Género</th>
                <th scope="col" class="text-center">Nombre Real</th>
                <th scope="col" class="text-center">Número Integrantes</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($resultadoArtista as $fila): ?>
            <tr>
                <td class="text-center"><?= $fila["CODIGO"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_ARTISTICO"]; ?></td>
                <td class="text-center"><?= $fila["GENERO_MUSICAL"]; ?></td>
                <td class="text-center"><?= $fila["NOMBRE_OFICIAL"]; ?></td>
                <td class="text-center"><?= $fila["NUMERO_INTEGRANTES"]; ?></td>
                <td class="text-center"><?= $fila["TIPO_ARTISTA"]; ?></td>
                <td class="text-center">
                    <form action="artista_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["CODIGO"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
endif;
include "../includes/footer.php";
?>
