<?php

require_once "../modeles/modeles.php";
if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Admin")
{

if(!empty($_POST["envoiCat"]) && $_POST["envoiCat"] == 1)
    {
        if(strlen($_POST["ajoutCat"]) >= 4 && strlen($_POST["ajoutCat"]) <= 35){

            if(ajouterCategorie($_POST["ajoutCat"]) == true){
                header("location:../pages/admin.php?success=ajoutCat");
            
            }else{
                header("location:../pages/admin.php?erreurs=ajoutCat");
            }


        }else{
            header("location:../pages/admin.php?erreurs=TailleCat");
        }
       
    }else{
        header("location:../pages/admin.php?erreurs=vide");
    }
}