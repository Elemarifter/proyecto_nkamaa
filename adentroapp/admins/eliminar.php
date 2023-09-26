<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../BD.php";
$sentencia = $base_de_datos->prepare("DELETE FROM users WHERE id = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE) {
	header("Location: correcto.html");
	exit();
} else {
	header("Location: Error.html");
	exit();
}
?>