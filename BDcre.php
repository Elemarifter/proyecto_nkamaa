<?php
	$servidor = "localhost";
	$contrasena = "";
	$usuario = "root";
	$bd = "nkamaa";

	$conexion = new mysqli ($servidor, $usuario, $contrasena,);

	if ($conexion->connect_error){
		die("Conexion fallida: " . $conexion->connect_error);
	}

	$sql = "CREATE DATABASE $bd";
	if($conexion->query($sql) === true){
		echo "Base de Datos Creada correctamente.";
	} else {
		die("Error al crear BD." . $conexion->error);
	}

	$conexion = new mysqli ($servidor, $usuario, $contrasena, $bd);

	$users = 
		"CREATE TABLE `$bd`.`users` (
		`id` INT(11) NOT NULL AUTO_INCREMENT,
		`name` VARCHAR(100) NOT NULL ,
		`username` VARCHAR(100) NOT NULL , 
		`password` VARCHAR(100) NOT NULL , 
		`birth` DATE NULL DEFAULT '0001-01-01', 
		`avatar` VARCHAR(200) NULL DEFAULT 'default.88440198jpg', 
		`email` VARCHAR(100) NOT NULL , 
		`gender` VARCHAR(100) NULL,
		`profile_t` VARCHAR(100) NULL,
		PRIMARY KEY (id));";



	if ($conexion->query($users) === true){
		echo "Tabla \"Users\"  creadas correctamente.";
	} else {
		die("Error al crear Tabla \"Users\"." . $conexion->error);
	}

	$chat = 
		"CREATE TABLE `$bd`.`chat` ( 
		`idmsg` INT(11) NOT NULL AUTO_INCREMENT,
		`idusr` INT(11) NOT NULL,
		`message` TEXT NOT NULL,
		`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		`nameusr` VARCHAR(100) NULL,
		PRIMARY KEY (`idmsg`),
		FOREIGN KEY (`idusr`) REFERENCES users(id));";


	if ($conexion->query($chat) === true){
		echo "Tabla \"Chat\" creadas correctamente.";
	} else {
		die("Error al crear Tabla \"Chat\"." . $conexion->error);
	}

	try{
		$base_de_datos = new PDO('mysql:host=localhost;dbname=' . $bd, $usuario, $contrasena);
	} catch(Exception $e){
		echo "Ocurrio algo con la base de datos: " . $e->getMessage();
	}	

?>