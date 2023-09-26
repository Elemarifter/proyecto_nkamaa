<?php
    if (!empty($_POST["nombres"]) && !empty($_POST["apellidos"]) && !empty($_POST["correo"]) && !empty($_POST["contrasena"])) {

    include_once "BD.php";
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $sentencia = $base_de_datos->prepare("INSERT INTO login(email, password, name, lastname) VALUES (?, ?, ?, ?);");
    $resultado = $sentencia->execute([$correo, $contrasena, $nombres, $apellidos]); 


    if($resultado === TRUE) {
        header("Location: creado.html");
        exit();
    } else {
        header("Location: Error2.html");
    }
} else {
    header("Location: datovacio.html");
    exit();
}


    ?>