<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$genero = $_POST["genero"];
$tipo = $_POST["tipo"];
$numero_integrantes = $_POST["numero_integrantes"];
$nombre_oficial = $_POST["nombre_oficial"];

$query = "";

if ($tipo == "Solista") { 
    if (empty($nombre_oficial)) {
        echo "Error: Un solista necesita un nombre real.";
    }
	else {
		$query = "INSERT INTO `artista` (`codigo`, `nombre_artistico`, `genero_musical`, `tipo_artista`, `numero_integrantes`, `nombre_oficial`) 
          VALUES ('$codigo', '$nombre', '$genero', '$tipo', NULL, '$nombre_oficial')";
	}
} elseif ($tipo == "Grupo") { 
    if (empty($numero_integrantes)) {
		echo "Error: Un Grupo necesita numero de integrantes.";
	} else{
		$query = "INSERT INTO `artista` (`codigo`, `nombre_artistico`, `genero_musical`, `tipo_artista`, `numero_integrantes`, `nombre_oficial`) 
          VALUES ('$codigo', '$nombre', '$genero', '$tipo', '$numero_integrantes', NULL)";
	}
}

if ($query){
	
	// Ejecutar consulta
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	
	// Redirigir al usuario a la misma pagina
	if($result):
		// Si fue exitosa, redirigirse de nuevo a la página de la entidad
		header("Location: artista.php");
	else:
		echo "Ha ocurrido un error al crear la persona";
	endif;
	
	mysqli_close($conn);
}
