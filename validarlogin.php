<?php
    session_start();

    if (!empty($_POST["correo"]) && !empty($_POST["contrasena"])) {

    include_once "BD.php";
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $sentencia = $base_de_datos->prepare("SELECT id, email, password FROM users WHERE email = ?;");
    $resultado = $sentencia->execute([$correo]); 
    $consulta = $sentencia->fetch(PDO::FETCH_OBJ);
    
    if ($correo = $consulta->email && $contrasena = $consulta->password) {
        $_SESSION["id"] = $consulta->id;
        header("Location: adentroapp/perfil.php");
        exit();
    } else {
        header("Location: datovacio.html");
        exit();
    }

} else {
    echo "pene";
}


    ?>