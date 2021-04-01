<?php
require_once "../modeles/modeles.php";

$requete = getBdd() -> prepare("SELECT identifiant FROM users WHERE identifiant = ?");
$requete -> execute([$_POST["identifiant"]]);
// $id = $requete -> fetch(PDO::FETCH_ASSOC);


if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["mdp"]))
    {
        if($requete -> rowCount() > 0)
        {
            if(connexion($_POST["identifiant"], $_POST["mdp"]) == true)
            {
                header("location:../pages/index.php");
            }
            else
            {
                header("location:../pages/connexion.php?error=Mdp");
            }   
        }
        else
        {
            header("location:../pages/connexion.php?error=IdFaux");
        }
    }
    else
    {
        header("location:../pages/connexion.php?error=IdMdpVide");
    }
}
else
{
    header("location:../pages/connexion.php?error=Inscription");
}