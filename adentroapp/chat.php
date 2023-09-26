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
    <link rel="stylesheet" href="../estilos/stylesad.css">
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
            text-align: center;
        }
    </style>
    <link rel="shortcut icon" href="../img/LOGO.png" />
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/LOGO.png" alt="logo del proyecto">
            <h2 class="nombre-empresa">Nkamaa</h2>
        </div>
        <nav>
            <a href="" class="">Contacto</a>
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

        <br>
        <br>

         &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
        <iframe src="chatfunc.php" width="680" height="480" style="overflow:hidden" frameBorder="0"> </iframe>
    
    </div>
</body>
</html>