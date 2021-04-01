<?php
require_once "../modeles/modeles.php";

$id = $_SESSION["idUser"];
if(!empty($_POST["valideModif"]) && $_POST["valideModif"] == 1)
{
    if(!empty($_POST["idUser"]))
    {
        if(!empty($_POST["modifPseudo"]) && !empty($_POST["modifEmail"]))
        {
            if(strlen($_POST["modifPseudo"]) < 50)
            {
                if(filter_var($_POST["modifEmail"], FILTER_VALIDATE_EMAIL))
                {
                    if(modifProfil($_POST["idUser"], $_POST["modifPseudo"], $_POST["modifEmail"]) == true)
                    {
                        
                        header("location:../pages/profil.php?idUser=$id&success=modifReussi");
                    }
                    else
                    {
                        header("location:../pages/profil.php?modifUser=$id&erreurs=modifError");
                    }
                }else{
                    header("location:../pages/profil.php?modifUser=$id&erreurs=mail");
                }
            }
            else
            {
                header("location:../pages/profil.php?modifUser=$id&erreurs=pseudoLong");
            }
        }
        else
        {
            header("location:../pages/profil.php?modifUser=$id&erreurs=ChampVide");
        }
    }
    else
    {
        header("location:../pages/profil.php?modifUser=$id&erreurs=errorGetUser");
    }
    
}else
{
    header("location:../pages/profil.php?modifUser=$id&erreurs=errorForm");
}