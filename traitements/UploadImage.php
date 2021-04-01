<?php
require_once "../modeles/modeles.php";

$uploadImage = uploadImage($_FILES);
$idUser = $_SESSION['idUser'];
if( $uploadImage == "success"){
    header("location:../pages/profil.php?idUser=$idUser&succes=$uploadImage");
}else{
    header("location:../pages/profil.php?idUser=$idUser&erreur=$uploadImage");
}