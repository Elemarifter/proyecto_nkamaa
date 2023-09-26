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

if( isset($_REQUEST['action']) ){


	switch( $_REQUEST['action'] ){



		case "SendMessage":

			$query = $base_de_datos->prepare("INSERT INTO chat(idusr, message) VALUES (?, ?);");

			$query->execute([$_SESSION['id'], $_REQUEST['message']]);

			echo 1;


		break;




		case "getChat":


			$query = $base_de_datos->prepare("SELECT * from chat");
			$query->execute();

			$rs = $query->fetchAll(PDO::FETCH_OBJ);
			

			$chat = '';
			foreach( $rs as $r ){

				$chat .=  '<div class="siglemessage"><strong>'.$r->idusr.' says:  </strong>'.$r->message.'</div>';

			}

			echo $chat;


		break;



	}


}


?>