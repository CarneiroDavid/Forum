<?php
require_once "../modeles/modeles.php";
$id=$_POST["idUser"];
if($_SESSION["statut"] == "Admin")
{
    if(!empty($_POST["EnvoiModif"]) && $_POST["EnvoiModif"] == 1){

        if(!empty($_POST["modifNom"]) && !empty($_POST["modifPrenom"]) && !empty($_POST["modifStatut"]) && !empty($_POST["modifPseudo"])  && !empty($_POST["idUser"]))
        {
                if(strlen($_POST["modifNom"]) < 20 && strlen($_POST["modifPrenom"]) <= 20 && strlen($_POST["modifPseudo"]) <= 20)
                {   
                    if (filter_var($_POST["modifEmail"], FILTER_VALIDATE_EMAIL) && !empty($_POST["modifEmail"]))
                    {
                        if(modifUser($_POST["modifNom"],$_POST["modifPrenom"],$_POST["modifStatut"],$_POST["modifPseudo"],$_POST["modifEmail"],$_POST["idUser"]) == true)
                        {
                            if(!empty($_POST["modifSection"])){
                                
                                if(modifierModo($_POST["modifSection"], $_POST["idUser"], $_POST["modifPseudo"]) == true)
                                {
                                    header("location:../pages/admin.php?success=modifUser");
                                }else{
                                    header("location:../pages/admin.php?erreurs=SectionNULL&modifUser=$id");
                                }
                                
                                
                            }else{
                                header("location:../pages/admin.php?success=modifUser");
                            }
                            
                        }else{
                            header("location:../pages/admin.php?erreurs=modifUser&modifUser=$id");
                        }
                    }else{
                        header("location:../pages/admin.php?erreurs=AdressMail&modifUser=$id");
                    }
                }else
                {
                    header("location:../pages/admin.php?erreurs=StrlenVar&modifUser=$id");
                }

        }else
        {
            header("location:../pages/admin.php?erreurs=VarVide&modifUser=$id");
        }
    }else
    {
        header("location:../pages/admin.php?erreurs=FormulaireVide&modifUser=$id");
    }
}else{
    header("location:../pages/index.php");
}