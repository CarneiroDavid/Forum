<?php
require_once "../modeles/modeles.php";
$idCategorie = $_POST["idCategorie"];
    if(!empty($_POST["envoiSujet"]) && $_POST["envoiSujet"] == 1)
    {
        if(!empty($_POST["contenuSujet"]) && !empty($_POST["creerSujet"]))
        {
           if(strlen($_POST["contenuSujet"]) < 1000 && strlen($_POST["creerSujet"]) < 100)
            {   
                if(ajouterSujet($_POST["creerSujet"], $_POST["idCategorie"], $_POST["contenuSujet"])==true)
                {
                    
                    header("location:../pages/index.php?success=Sujet&idCategorie=$idCategorie");
                }else
                {
                    header("location:../pages/index.php?erreurs=Sujet&idCategorie=$idCategorie");
                }
            }else
            {
                header("location:../pages/index.php?erreurs=TailleSujetNom&idCategorie=$idCategorie");
            } 
        }else
        {
            header("location:../pages/index.php?erreurs=SujetNomVide&idCategorie=$idCategorie");
        }
    }else
    {
        header("location:../pages/index.php?erreurs=FormulaireVide&idCategorie=$idCategorie");
    }   