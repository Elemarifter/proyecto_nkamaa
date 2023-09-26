<?php
    if (!empty($_POST["nombres"]) && !empty($_POST["usuario"]) && !empty($_POST["correo"]) && !empty($_POST["contrasena"])) {

    include_once "BD.php";
    $nombres = $_POST["nombres"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $sentencia = $base_de_datos->query("SELECT * FROM users WHERE username = \"$usuario\";");
    $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

    foreach($usuarios as $profiles)

    if($usuarios>=1) {
        header("Location: repetido.html");
        exit();
    }

    $sentencia = $base_de_datos->query("SELECT * FROM users WHERE email = \"$correo\";");
    $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

    foreach($usuarios as $profiles)

    if($usuarios>=1) {
        header("Location: repetido.html");
        exit();
    }

    $sentencia = $base_de_datos->prepare("INSERT INTO users(email, password, name, username, birth) VALUES (?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([$correo, $contrasena, $nombres, $usuario, '0001-01-01']); 

    


    if($resultado === TRUE) {
    header("Location: creado.html");
    exit();
    } else {
    header("Location: Error2.html");
    exit();
    }
} else {
    header("Location: datovacio.html");
    exit();




}
    ?>

