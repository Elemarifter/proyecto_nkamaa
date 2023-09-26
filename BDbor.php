<?php
	$servidor = "localhost";
	$contrasena = "";
	$usuario = "root";
	$bd = "nkamaa";

	$conexion = new mysqli ($servidor, $usuario, $contrasena, $bd);

	$borrar = 
		"DROP DATABASE nkamaa;";

	if ($conexion->query($borrar) === true){
		echo "Borrado correctamente correctamente.";
	} else {
		die("Error." . $conexion->error);
	}

?>