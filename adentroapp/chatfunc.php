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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat System</title>
	<link rel="stylesheet" href="C:\wamp\www\proyecto_nkamaa/estilos\styleschat.css" type="text/css" />
	<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <style>
    
    *{
        padding:0px;
        margin:0px;
    }

    .centeralised{
        margin:10px auto;
        width:600px;
        text-align:center;
    }

    .chathistory{
        min-height:300px;
        width:500px;
        margin:10px auto;
        padding:10px;
        background:#f1f1f1;
        text-align:left;
    }


    .txtarea{
        min-height:70px;
        width:500px;
        margin:10px auto;
        padding:10px;
    }

    .siglemessage{
        font-size:12px;
        padding:5px;
        border-bottom:1px solid #b3b3b3;
    }

    </style>
</head>
<body>
	
	<div class="centeralised">
	
	    <div class="chathistory"></div>
            <div class="chatbox">
                <form action="" method="POST">
                    <textarea class="txtarea" id="message" name="message"></textarea>
                </form>
            </div>
	</div>
	
	<script>
		$(document).ready(function(){
			loadChat();
		});
		
		$('#message').keyup(function(e){
			var message = $(this).val();
			if( e.which == 13 ){
				$.post('handlers/ajax.php?action=SendMessage&message='+message, function(response){
					
					loadChat();
					$('#message').val('');
				});
			}
		});
		function loadChat()
		{
			$.post('./handlers/ajax.php?action=getChat', function(response){
				
				$('.chathistory').html(response);
			});
		}
		setInterval(function(){
			loadChat();
		}, 2000);
	</script>
</body>
</html>