<?php
require_once "../modeles/modeles.php";
if($_SESSION["statut"] == "Admin"){
    if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
    {
        if(!empty($_POST["identifiant"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dateNaiss"]) && !empty($_POST["email"]) &&!empty($_POST["pseudo"]) && !empty($_POST["statut"]) && !empty($_POST["mdp"]) && $_POST["mdp2"])
        {
            if(strlen($_POST["identifiant"]) <= 20)
            {
                if(strlen($_POST["nom"]) <= 20)
                {
                    if(strlen($_POST["prenom"]) <= 20)
                    {
                        if(strlen($_POST["pseudo"]) <= 20)
                        {
                            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["email"]))
                                {
                                    if($_POST["mdp"] == $_POST["mdp2"])
                                    {
                                        if(strlen($_POST["mdp"]) <= 20)
                                        {
                                            $ajoutUser= ajoutUser($_POST["identifiant"],$_POST["nom"],$_POST["prenom"],$_POST["pseudo"],$_POST["dateNaiss"],$_POST["email"], $_POST["mdp"], $_POST["statut"]);

                                            if($ajoutUser == "success"){
                                                header("location:../pages/admin.php?success=AjoutUser");
                                            }else{
                                                header("location:../pages/creationUser.php?erreurs=$ajoutUser");
                                            }
                                        }else{
                                            header("location:../pages/creationUser.php?erreurs=mdpTaille");
                                        }
                                    }else{
                                        header("location:../pages/creationUser.php?erreurs=valMdp");
                                    }
                                }else{
                                    header("location:../pages/creationUser.php?erreurs=AdressMail");
                                }
                        }else{
                            header("location:../pages/creationUser.php?erreurs=pseudoTaille");
                        }

                    }else{
                        header("location:../pages/adcreationUsermin.php?erreurs=prenomTaille");
                    }
                }else{
                    header("location:../pages/creationUser.php?erreurs=nomTaille");
                }
            }else{
                header("location:../pages/creationUser.php?erreurs=idTaille");
            }
        }else{
            header("location:../pages/creationUser.php?erreurs=VarVide");
        }
    }else{
        header("location:../pages/creationUser.php?erreurs=vide");
    }
}else{
    header("location:../pages/index.php");
}