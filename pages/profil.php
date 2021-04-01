<?php
require_once "entete.php";
if(!empty($_GET["erreur"]))
{
    ?>
    <div class="alert alert-danger">
    
    <?= $_GET["erreur"];?>
    </div>
    <?php
}
if(!empty($_GET["erreurs"]))
{
    ?>
    <div class="alert alert-danger" style="text-align:center;">
    <?php
        switch($_GET["erreurs"])
        {
            case "errorForm":
                echo "Erreur de formulaire";
                break;
            case "errorGetUser":
                echo "Erreur de connexion";
                break;
            case "ChampVide":
                echo "L'un des champ est vide, veuillez renseigner tous les champs";
                break;
            case "pseudoLong":
                echo "Le pseudos saisit est trop long, veuillez en renseigner un nouveau";
                break;
            case "modifError":
                echo "Erreur de modification, veuillez réessayer";
                break;
            case "mail":
                echo "l'adresse mail saisit n'est pas valide";
                break;
        }
    ?>    
    </div>
    <?php

}
if(!empty($_GET["idUser"]))
{
    afficherProfil($_GET["idUser"]);
}

if(!empty($_GET["modifUser"]))
{
    modifierProfil($_GET["modifUser"]);
}
if(!empty($_POST["envoiModif"]))
{
    uploadImage($_FILES);
}
?>