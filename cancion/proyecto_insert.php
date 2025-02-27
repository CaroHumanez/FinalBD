<?php
 
// Crear conexión con la BD
require('../config/conexion.php');


// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$titulo = $_POST["titulo"];
$codigo_album = $_POST["album"];
$fechalanzamiento = $_POST["fechalanzamiento"];
$duracion = $_POST["duracion"];
$inspiracion = $_POST["inspiracion"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `cancion`(`CODIGO`,`TITULO`, `FECHA_LANZAMIENTO`, `DURACION`, `CODIGO_ALBUM`, `CODIGO_INSPIRACION`) VALUES ('$codigo', '$titulo','$fechalanzamiento', '$duracion', '$codigo_album', '$inspiracion')";


// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: proyecto.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);