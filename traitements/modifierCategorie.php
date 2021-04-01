<?php

require_once "../modeles/modeles.php";
$id = $_POST["idModif"];
if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Admin")
{
   
    if(!empty($_POST["envoiModif"]) && $_POST["envoiModif"] == 1)
    {
        if(strlen($_POST["modifCat"]) >= 4 && strlen($_POST["modifCat"]) <= 35)
        {
            if(modifierCategorie($_POST["idModif"], $_POST["modifCat"]) == true)
            {
                header("location:../pages/admin.php?success=modifCat&idCat=$id");
            }
            else
            {
                header("location:../pages/admin.php?erreurs=modifCat&idCat=$id");
            }
            
        }
        else
        {
            header("location:../pages/admin.php?erreurs=TailleCat&idCat=$id");
        }
    }
    else
    {
        header("location:../pages/admin.php?erreurs=vide&idCat=$id");        
    }
}