<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../BD.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM login WHERE id = ?;");
$sentencia->execute([$id]);
$usuario = $sentencia->fetch(PDO::FETCH_OBJ);
if($usuario === FALSE){
	header("Location: Error.html");
	exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../estilos/stylesadmin.css">
    <title>Nkamaa</title>
    <style>
        body{
            font-family: sans-serif;
        }
        .bienvenida{
            background-color: #779ecb;
            height: 20vh;
            margin: 8%;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/LOGO3.png" alt="logo del proyecto">
            <h2 class="nombre-empresa">Nkamaa</h2>
        </div>
        <nav>
            <a href="" class="">Contacto</a>
        </nav>
    </header>

    <section class="form-register">
        <form action="guardarDatosEditados.php" method="POST" >
            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
            <label for="correo">Correo:</label>
            <br>
            <input class="controls" value="<?php echo $usuario->email ?>" name="correo" required type="text" id="correo" placeholder="Correo">
            <br>
            <label for="contrasena">Contraseña:</label>
            <br>
            <input class="controls" value="<?php echo $usuario->password ?>" name="contrasena" required type="text" id="contrasena" placeholder="Contraseña">
            <br>
            <label for="contrasena">Nombres:</label>
            <br>
            <input class="controls" value="<?php echo $usuario->name ?>" name="nombres" required type="text" id="nombres" placeholder="Nombres">
            <br>
            <label for="contrasena">Apellidos:</label>
            <br>
            <input class="controls" value="<?php echo $usuario->lastname ?>" name="apellidos" required type="text" id="apellidos" placeholder="Apellidos">
            <br><input class="botons" type="submit" value="Guardar cambios">
        </form>
    </section>
</body>
</html>