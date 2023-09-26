<?php 
    session_start();
    include_once "../../BD.php";

    if(!isset($_POST["submit"]) && !isset($_POST["avatar"])) {
        echo "<pre>";
        print_r($_FILES["avatar"]);
        echo "</pre>";

        $idus = $_SESSION["id"];
        $idid = $_POST["idid"];
        $nombre_img = $_FILES["avatar"]["name"];
        $tamano_img = $_FILES["avatar"]["size"];
        $tiemp_name = $_FILES["avatar"]["tmp_name"];
        $error = $_FILES["avatar"]["error"];

        //"avatar\"$idus\"";

        if ($error === 0) {
            if ($tamano_img > 125000) {
                header("Location: Errorimg.html");
            } else {
                $img_ex = pathinfo($nombre_img, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);   
                
                $allowed_ex = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_ex)) {
                    $new_image_name= uniqid("IMG", true).`.`.$img_ex_lc;
                    $img_upload_path = "../imgusr/" . $new_image_name;
                    move_uploaded_file($tiemp_name, $img_upload_path); 
                    $sentencia = $base_de_datos->prepare("UPDATE users SET avatar = (?) WHERE id = ? ;");
                    $resultado = $sentencia->execute([$new_image_name, $idid]); 

                    if($resultado === TRUE) {
                        header("Location: editar.php?id=$idid");
                        exit();
                        } else {
                            header("Location: Error.html");
                        }

                } else {
                    header("Location: Error.html");
                }
                
            }

        } else {
            header("Location: Error.html");
        }

    } else {
        header("location: editar.php?id=$idid?");
    }

?>