<?php
require_once "../modeles/modeles.php";

if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dateNaiss"]) && !empty($_POST["email"]) && !empty($_POST["pseudo"]) && !empty($_POST["mdp"]) && !empty($_POST["mdp2"]))
    {
        if(strlen($_POST["identifiant"]) < 50 && strlen($_POST["nom"]) < 100 && strlen($_POST["prenom"]) < 100 && strlen($_POST["pseudo"] < 100))
        {
            if((int)date("Y") - (int)substr($_POST["dateNaiss"], 0, -6) > 13)
            {
                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                {
                    $requete = getBdd() -> prepare("SELECT email FROM users WHERE email = ?");
                    $requete -> execute([$_POST["email"]]);
                    if($requete -> rowCount() == 0)
                    {
                        $requete = getBdd() -> prepare("SELECT identifiant FROM users WHERE identifiant = ?");
                        $requete -> execute([$_POST["identifiant"]]);
                        if($requete -> rowCount() == 0)
                        {
                            $requete = getBdd() -> prepare("SELECT pseudo FROM users WHERE pseudo = ?");
                            $requete -> execute([$_POST["pseudo"]]);
                            if($requete -> rowCount() == 0)
                            {
                                if($_POST["mdp"] == $_POST["mdp2"])
                                {
                                    if(inscription($_POST["identifiant"], $_POST["email"], $_POST["nom"], $_POST["prenom"], $_POST["dateNaiss"], $_POST["pseudo"], $_POST["mdp"]) == true)
                                    {
                                        header("location:../pages/index.php");
                                    }
                                    else
                                    {
                                        header("location:../pages/inscription.php?error=erreurInscription");
                                    }
                                }
                                else
                                {
                                    header("location:../pages/inscription.php?error=MdpIncorrect");
                                }
                            }else
                            {
                                header("location:../pages/inscription.php?error=pseudoPrit");
                            } 
                        }
                        else
                        {
                            header("location:../pages/inscription.php?error=identifiantIncorrect");
                        } 
                    }
                    else
                    {
                        header("location:../pages/inscription.php?error=emailIncorrect");
                    }
                }
                else
                {
                    header("location:../pages/inscription.php?error=emailInvalide");
                }
            }
            else
            {
                header("location:../pages/inscription.php?error=dateNaissInvalide");
            }
        }
        else
        {
            header("location:../pages/inscription.php?error=champLong");
        }
    }
    else
    {
        header("location:../pages/inscription.php?error=champVide");
    }
}
else
{
    header("location:../pages/inscription.php?error=formNonEnvoyer");
}