<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    La cédula de un mecánico y un rango de fechas (es decir, dos fechas f1 y f2
    (cada fecha con día, mes y año) y f2 >= f1).<br> Se debe mostrar el valor total de las
    reparaciones correspondientes a ese mecánico durante ese rango de fechas.<br><br>

    Equivalente a: <br><br>

    El código de un album y un rango de fechas (es decir, dos fechas f1 y f2
    (cada fecha con día, mes y año) y f2 >= f1).<br> Se debe mostrar el valor total de las
    duraciones de las canciones correspondientes a ese album durante ese rango de fechas.<br><br>
</p>

<!-- FORMULARIO -->
<div class="formulario p-4 m-3 border rounded-3">
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_album" class="form-label">Código de album</label>
            <input type="number" class="form-control" id="codigo_album" name="codigo_album" required>
        </div> 

        <div class="mb-3">
            <label for="fecha1" class="form-label">Fecha 1</label>
            <input type="date" class="form-control" id="fecha1" name="fecha1" required>
        </div>

        <div class="mb-3">
            <label for="fecha2" class="form-label">Fecha 2</label>
            <input type="date" class="form-control" id="fecha2" name="fecha2" required>
        </div>       
        
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];
    $codigo_album = $_POST["codigo_album"];

    // Query SQL adaptada a la analogía
    $query = "SELECT ALBUM.CODIGO, ALBUM.TITULO, SUM(CANCION.DURACION) AS DURACION_CANCIONES FROM ALBUM
                JOIN 
                CANCION ON ALBUM.CODIGO = CANCION.CODIGO_ALBUM
                WHERE CANCION.FECHA_LANZAMIENTO > '$fecha1' AND
                        CANCION.FECHA_LANZAMIENTO < '$fecha2' AND
                        ALBUM.CODIGO = '$codigo_album'
                GROUP BY ALBUM.CODIGO
                ;";

    // Ejecutar la consulta
    $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if ($resultadoB1 && $resultadoB1->num_rows > 0):
        $fila = mysqli_fetch_assoc($resultadoB1);
        // Mostrar el resultado en formato de texto
        echo "<p>Del album <strong>" . $fila["TITULO"] . "</strong> las canciones lanzadas entre <strong>" . $fecha1 . "</strong> y <strong>" . $fecha2 . "</strong> tienen una duracion en total de <strong>" . $fila["DURACION_CANCIONES"] . "</strong> segundos.</p>";
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
