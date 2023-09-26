<?php

if(
	!isset($_POST["correo"]) || 
	!isset($_POST["contrasena"]) || 
	!isset($_POST["nombres"]) || 
	!isset($_POST["usuario"]) || 
	!isset($_POST["genero"]) ||
	!isset($_POST["cumple"]) ||
	!isset($_POST["perfil_t"]) ||
	!isset($_POST["id"])
) {
    header("Location: Error.html");
    exit();
}

include_once "../../BD.php";
$id = $_POST["id"];
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];
$nombres = $_POST["nombres"];
$usuario = $_POST["usuario"];
$genero = $_POST["genero"];
$cumple = $_POST["cumple"];
$perfil_t = $_POST["perfil_t"];

$sentencia = $base_de_datos -> prepare("UPDATE users SET email = ?, password = ?, name = ?, username = ?, gender = ?, birth = ?, profile_t = ? WHERE id = ?;");
$resultado = $sentencia->execute([$correo, $contrasena, $nombres, $usuario, $genero, $cumple, $perfil_t, $id]);
if($resultado === TRUE) {
	header("Location: correcto.html");
	exit();
} else {
	header("Location: Error.html");
	exit();
}
?>
