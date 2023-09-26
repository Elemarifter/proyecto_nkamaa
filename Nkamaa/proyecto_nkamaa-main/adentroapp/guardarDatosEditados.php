<?php

if(
	!isset($_POST["correo"]) || 
	!isset($_POST["contrasena"]) || 
	!isset($_POST["nombres"]) || 
	!isset($_POST["apellidos"]) || 
	!isset($_POST["id"])
) {
    header("Location: Error.html");
    exit();
}

include_once "../BD.php";
$id = $_POST["id"];
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];

$sentencia = $base_de_datos -> prepare("UPDATE login SET email = ?, password = ?, name = ?, lastname = ? WHERE id = ?;");
$resultado = $sentencia->execute([$correo, $contrasena, $nombres, $apellidos, $id]);
if($resultado === TRUE) {
	header("Location: correcto.html");
	exit();
} else {
	header("Location: Error.html");
	exit();
}
?>
