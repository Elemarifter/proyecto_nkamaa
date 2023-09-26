<?php
include_once "../BD.php";
$sentencia = $base_de_datos->query("SELECT * FROM login;");
$usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Correo</th>
				<th>Contraseña</th>
                <th>Nombres</th>
                <th>Apellidos</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($usuarios as $users){ ?>
			<tr>
				<td><?php echo $users->id ?></td>
				<td><?php echo $users->email ?></td>
				<td><?php echo $users->password ?></td>
                <td><?php echo $users->name ?></td>
                <td><?php echo $users->lastname ?></td>
				<td><a href="<?php echo "editar.php?id=" . $users->id?>">Editar</a></td>
				<td><a href="<?php echo "eliminar.php?id=" . $users->id?>">Eliminar</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
    </section>
</body>
</html>