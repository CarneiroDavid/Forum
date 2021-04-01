<?php

require_once "../modeles/modeles.php";

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Admin")
{
    if(!empty($_POST["idUser"]))
    {
        if(supprimerUtilisateur($_POST["idUser"]) == true)
        {
            header("location:../pages/admin.php?success=UserSuppr");
        }
        else
        {
            header("location:../pages/admin.php?error=UserPasSuppr");
        }
    }
    else
    {
        header("location:../pages/admin.php?error=idUserVide");
    }
}
else
{
    header("location:../pages/admin.php?error=PasAdmin");
}