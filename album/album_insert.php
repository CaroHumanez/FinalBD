<?php
 
// Crear conexión con la BD
require('../config/conexion.php');


// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$anio = $_POST["anio"];
$artista = $_POST["artista"];
$creditos = $_POST["creditos"];



// Verificar que 'codigo' sea positivo y 'anio' (año de lanzamiento) sea un año válido
if ($codigo <= 0 || $anio <= 0) {
    echo "Error: El código y el año de lanzamiento deben ser valores positivos.";
    exit();
}

$anio_actual = date("Y");
// Verificar que el anio (año de lanzamiento) sea menor al año actual
if ($anio >= $anio_actual) {
    echo "Error: El año de lanzamiento debe ser anterior al año actual ($anio_actual).";
    exit();
}

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `album`(`CODIGO`,`TITULO`, `ANO_LANZAMIENTO`, `CODIGO_ARTISTA`, `CREDITOS`) VALUES ('$codigo', '$nombre', '$anio', '$artista', '$creditos')";



// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: album.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);