<?php
require_once "modeles.php";

function modifierModo($id,$idUser,$pseudo)
{
    $requete = getBdd()->prepare("SELECT * FROM moderateurs WHERE idUser = ?");
    $requete -> execute([$idUser]);
    if($requete->rowCount() == 0){
        $requete = getBdd()-> prepare("INSERT INTO moderateurs (idCategorie,idUser,pseudo) VALUES (?,?,?)");
        $requete->execute([$id,$idUser,$pseudo]);
    }else{
        $requete = getBdd()->prepare("UPDATE moderateurs SET idCategorie = ?, pseudo = ? WHERE idUser = ?");
        $requete->execute([$id,$pseudo,$idUser]);
    }
    return true;
}