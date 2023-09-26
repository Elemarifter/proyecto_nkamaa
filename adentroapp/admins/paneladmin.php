<?php
session_start();
include_once "../../BD.php";
$sentencia = $base_de_datos->query("SELECT * FROM users;");
$usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

$idus = $_SESSION["id"];
$datop = $base_de_datos->query("SELECT * FROM users WHERE id = \"$idus\" ;");
$datoc = $datop->fetchAll(PDO::FETCH_OBJ);

if(!isset($idus)) {
    header("Location: ../index.html");
}

foreach($datoc as $datos){

    if ($datos->profile_t != "AD") {
        header("Location: ../../../index.html");
    } 

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="../../estilos/stylesadmin.css">
    <title>Nkamaa</title>
    <link rel="shortcut icon" href="../../img/LOGO.png" />
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
            width: 50px;
            height: 50px;
            padding: 5px;
        }

        .alb img {
            width: 100%;
            height: 100%;
            border-radius:25%;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../img/LOGO.png" alt="logo del proyecto">
            <h2 class="nombre-empresa">Nkamaa</h2>
        </div>
        <nav>
            <a href="../perfil.php">Volver</a>
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
        <div id="photo"> <img src="../imgusr/<?=$avatarr;?>" alt=""> </div>
        <div id="name"> <span> <?php echo $datos->name; ?> </span> </div>
    </div>
       
    <!-- Items -->

    <div id="menu-items">

        <div class="item">
            <a href="../perfil.php">
                <div class="icon"> <img src="../../img/iconos/perfil.png" alt=""> </div>
                <div class="title"> <span> Mi Perfil </span> </div>
            </a>
        </div>

        <div class="item">
            <a href="../chat.php">
                <div class="icon"> <img src="../../img/iconos/chat.png" alt=""> </div>
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

    <section class="form-register">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Correo</th>
				<th>Contraseña</th>
                <th>Nombres</th>
                <th>Usuario</th>
                <th>Fecha de Nacimiento</th>
                <th>Avatar</th>
                <th>Genero</th>
                <th>Perfil</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($usuarios as $profiles){ ?>
			<tr>
				<td><?php echo $profiles->id ?></td>
				<td><?php echo $profiles->email ?></td>
				<td><?php echo $profiles->password ?></td>
                <td><?php echo $profiles->name ?></td>
                <td><?php echo $profiles->username ?></td>
                <td><?php echo $profiles->birth ?></td>
                <td><?php $avatarr = $profiles->avatar;?>
                <div class="alb">
                        <img src="../imgusr/<?=$avatarr;?>">
                </div></td>
                <td>
                <?php 
                    if ($profiles->gender == "H") {
                        echo "Hombre";
                    } else {
                        echo "Mujer";
                    }?></td>
                <td>
                <?php 
                    if ($profiles->profile_t == "US") {
                        echo "Usuario";
                    } elseif ($profiles->profile_t == "AC") {
                        echo "Acompañante";
                    } else {
                        echo "Administrador";
                    }?></td>
				<td><a href="<?php echo "editar.php?id=" . $profiles->id?>">Editar</a></td>
				<td><a href="<?php echo "eliminar.php?id=" . $profiles->id?>">Eliminar</a></td>
			</tr>
            
			<?php } ?>
		</tbody>
	</table>
    </section>
</body>
</html>