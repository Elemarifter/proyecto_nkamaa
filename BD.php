<?php
$contrasena = "";
$usuario = "root";
$bd = "nkamaa";
try{
	$base_de_datos = new PDO('mysql:host=localhost;dbname=' . $bd, $usuario, $contrasena);
} catch(Exception $e){
	echo "Ocurrio algo con la base de datos: " . $e->getMessage();
}

?>