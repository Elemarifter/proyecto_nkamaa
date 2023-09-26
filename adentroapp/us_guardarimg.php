<?php 
    session_start();
    include_once "../BD.php";

    if(!isset($_POST["submit"]) && !isset($_POST["avatar"])) {
        echo "<pre>";
        print_r($_FILES["avatar"]);
        echo "</pre>";

        $idus = $_SESSION["id"];
        $nombre_img = $_FILES["avatar"]["name"];
        $tamano_img = $_FILES["avatar"]["size"];
        $tiemp_name = $_FILES["avatar"]["tmp_name"];
        $error = $_FILES["avatar"]["error"];

        //"avatar\"$idus\"";

        if ($error === 0) {
            if ($tamano_img > 125000) {
                $em = "Tu archivo es muy Grande.";
                header("location: us_editar.php?error=$em");
            } else {
                $img_ex = pathinfo($nombre_img, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);   
                
                $allowed_ex = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_ex)) {
                    $new_image_name= uniqid("IMG", true).`.`.$img_ex_lc;
                    $img_upload_path = "imgusr/" . $new_image_name;
                    move_uploaded_file($tiemp_name, $img_upload_path); 
                    $sentencia = $base_de_datos->prepare("UPDATE users SET avatar = (?) WHERE id = ? ;");
                    $resultado = $sentencia->execute([$new_image_name, $idus]); 

                    if($resultado === TRUE) {
                        header("Location: us_editar.php");
                        exit();
                        } else {
                        header("Location: us_Error.html");
                        }

                } else {
                    $em = "Tipo de Archivo no Soportado.";
                    header("location: us_editar.php?error=$em");
                }
                
            }

        } else {
            $em = "Error desconocido.";
            header("location: us_editar.php?error=$em");
        }

    } else {
        header("location: us_editar.php");
    }

?>