<?php

require_once "modeles.php";

function ajouterSujet($nom, $idCategorie, $message)
{
    $nom = htmlspecialchars($nom, ENT_QUOTES);
    $message = htmlspecialchars($message, ENT_QUOTES);
    $erreurs = [];
    $requete = getBdd() -> prepare("SELECT idCategorie FROM categories WHERE idCategorie = ?");
    $requete -> execute([$idCategorie]);
    if($requete -> rowCount() == 0)
    {
        $erreurs = "La catégorie n'existe pas"; 
    }
    else
    {
         
        try{
            $requete = getBdd() -> prepare("INSERT INTO sujet (nom, idUser, pseudo, idCategorie, msg) VALUES(?, ?, ?, ?, ?)");
            $requete -> execute([$nom, $_SESSION["idUser"], $_SESSION["pseudo"], $idCategorie, $message]);
            return true;            
        }catch(Exception $e)
        {
            header("location:../pages/index.php?error=erreurInjection");
        }
    }
}

function modifSujet($titre, $message, $idSuj)
{
    $titre = htmlspecialchars($titre, ENT_QUOTES);
    $message = htmlspecialchars($message, ENT_QUOTES);
    try 
    {
        $requete = getBdd() -> prepare("UPDATE sujet SET nom = ?, msg = ? WHERE idSujet = ?");
        $requete -> execute([$titre, $message, $idSuj]);
        return true;
    }
    catch(Exception $e)
    {
        
    }
}

function supprimerSujet($idSuj)
{
    $requete = getBdd() -> prepare("DELETE FROM sujet WHERE idSujet = ?");
    $requete -> execute([$idSuj]);
    $requete = getBdd() -> prepare("DELETE FROM messages WHERE idSujet = ?");
    $requete -> execute([$idSuj]);
    return true;

}


?>