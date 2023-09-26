<?php
session_start();
include_once "../BD.php";
$sentencia = $base_de_datos->query("SELECT * FROM users;");
$usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

$idus = $_SESSION["id"];
$datop = $base_de_datos->query("SELECT * FROM users WHERE id = \"$idus\" ;");
$datoc = $datop->fetchAll(PDO::FETCH_OBJ);

if(!isset($idus)) {
    header("Location: ../index.html");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        .alb {
            width: 200px;
            height: 200px;
            padding: 5px;
        }

        .alb img {
            width: 100%;
            height: 100%;
            border-radius:25%;
        }

    </style>
    <link rel="shortcut icon" href="../img/LOGO.png" />
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/LOGO.png" alt="logo del proyecto">
            <h2> <a href="perfil.php" class="">Nkamaa</a> <h2>
        </div>
        <nav>
            
            <a href="perfil.php">Volver</a>
        </nav>

    </header>

    <div id="sidemenu" class="menu-collapsed">

    <!-- Cabecera -->

        <div id="header">
            <div id="title"> <span>Nkamaa</span> </div>
                <div id="menu-btn"> 
                    <div class="btn-hamburger"> </div>
                    <div class="btn-hamburger"> </div>
                    <div class="btn-hamburger"> </div>
                </div>
        </div>

    <!-- Perfil -->

    <?php foreach($datoc as $datos){ 
    $avatarr = $datos->avatar;
    ?>

    <div id="profile">
        <div id="photo"> <img src="imgusr/<?=$avatarr;?>" alt=""> </div>
        <div id="name"> <span> <?php echo $datos->name; ?> </span> </div>
    </div>
       
    <!-- Items -->

    <div id="menu-items">

        <div class="item">
            <a href="perfil.php">
                <div class="icon"> <img src="../img/iconos/perfil.png" alt=""> </div>
                <div class="title"> <span> Mi Perfil </span> </div>
            </a>
        </div>

        <div class="item">
            <a href="chat.php">
                <div class="icon"> <img src="../img/iconos/chat.png" alt=""> </div>
                <div class="title"> <span> Chat </span> </div>
            </a>
        </div>
    </div>

    <?php } ?>
</div>

        <script>
            const btn = document.querySelector("#menu-btn");
            const menu = document.querySelector("#sidemenu");
            btn.addEventListener("click", e=> {
                menu.classList.toggle("menu-expanded");
                menu.classList.toggle("menu-collapsed");

                document.querySelector("body").classList.toggle("body-expanded");
            });

        </script>
        
    <?php foreach($datoc as $datos){ 
        $avatarr = $datos->avatar;
        ?>

    <section class="form-register">

        <table>
	        <td>
                <th>
                    <div class="alb">
                            <img src="imgusr/<?=$avatarr;?>">
                    

                    <form action="us_guardarimg.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="avatar">
                        <input type="submit" name="submit value="Subir avatar">
                    </form>
                    </div>
                </th>

            </td>

        

    <br>

    <td> <h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </h1> </td>


        <th>
            <form action="us_guardarDatosEditados.php" method="POST" >
                <input type="hidden" name="id" value="<?php echo $datos->id; ?>">
                <label for="correo">Correo:</label>
                <br>
                <input class="controls" value="<?php echo $datos->email ?>" name="correo" required type="text" id="correo" placeholder="Correo">
                <br>
                <label for="contrasena">Contraseña:</label>
                <br>
                <input class="controls" value="<?php echo $datos->password ?>" name="contrasena" required type="text" id="contrasena" placeholder="Contraseña">
                <br>
                <label for="contrasena">Nombres:</label>
                <br>
                <input class="controls" value="<?php echo $datos->name ?>" name="nombres" required type="text" id="nombres" placeholder="Nombres">
                <br>
                <label for="contrasena">Nombre de Usuario:</label>
                <br>
                <input class="controls" value="<?php echo $datos->username ?>" name="usuario" required type="text" id="Usuario" placeholder="Nombre de Usuario">
                <label for="contrasena">Genero:</label>
                <br>
                <select name="genero" id="genero" ?>">
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                    <option value="O">Otro</option>
                </select>
                <br>
                <br>
                <label for="contrasena">Fecha de Nacimiento:</label>
                <br>
                <input type="date" id="cumple" name="cumple" >
                <br>
                <br>
                <label for="contrasena">Tipo de Perfil:</label>
                <br>
                <select name="perfil_t" id="perfil_t" ?>">
                    <option value="US">Usuario</option>
                    <option value="AC">Acompañante</option>
                    <?php if ($datos->profile_t == "AD") {
                                ?> <option value="AD">Administrador</option> 
                            <?php }?>
                </select>
                <br>
                <br><input class="botons" type="submit" value="Guardar cambios">
            </form>

    </section>
			</th>
        </table>


			<?php }  ?>

        <h2 class="nombre-empresa"></h2>

    
</body>
</html>