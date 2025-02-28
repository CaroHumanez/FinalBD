<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$genero = $_POST["genero"];
$tipo = $_POST["tipo"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `artista`(`codigo`,`nombre_artistico`, `genero_musical`, `tipo_artista`, `numero_integrantes`, `nombre_oficial`) VALUES ('$codigo', '$nombre', '$genero', '$tipo', NULL, 'Ernesto')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: cliente.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);