<?php
require_once "../modeles/modeles.php";

$idSuj = $_POST["getSuj"];
if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
{
    if(!empty($_POST["modifTitre"]) && !empty($_POST["modifSuj"]))
    {
        if(strlen($_POST["modifTitre"]) >= 4)
        {
            if(strlen($_POST["modifTitre"]) <= 100)
            {
                if(strlen($_POST["modifSuj"]) >= 4)
                {
                    if(strlen($_POST["modifSuj"]) <= 250)
                    {
                        if(modifSujet($_POST["modifTitre"], $_POST["modifSuj"], $idSuj) == true)
                        {
                            header("location:../pages/index.php?idSujet=$idSuj&success=SujetModif");
                        }
                        else
                        {
                            header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=ModifProbleme");
                        }
                    }
                    else
                    {
                        header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=MessageLong");
                    }
                }
                else
                {
                    header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=MessageCourt");
                }
            }
            else
            {
                header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=TitreLong");
            }
        }
        else
        {
            header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=TitreCourt");
        }       
    }
    else
    {
        header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=TitreMessVide");
    }
}
else
{
    header("location:../pages/modifierSujet.php?idSujet=$idSuj&error=Erreur");

}