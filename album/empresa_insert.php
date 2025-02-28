<?php
 
// Crear conexión con la BD
require('../config/conexion.php');


// Sacar los datos del formulario. Cada input se identifica con su "name"
$nit = $_POST["nit"];
$nombre = $_POST["nombre"];
$presupuesto = $_POST["presupuesto"];
$artista = $_POST["artista"];
$creditos = $_POST["creditos"];

// Verificar que 'codigo' y 'año de lanzamiento' sean positivos
if ($nit <= 0 || $presupuesto <= 0) {
    echo "Error: El código y el año de lanzamiento deben ser valores positivos.";
    exit(); // Detener la ejecución del script
}

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `album`(`CODIGO`,`TITULO`, `ANO_LANZAMIENTO`, `CODIGO_ARTISTA`, `CREDITOS`) VALUES ('$nit', '$nombre', '$presupuesto', '$artista', '$creditos')";



// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: empresa.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);