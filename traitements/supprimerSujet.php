<?php
require_once "../modeles/modeles.php";
$requete = getBdd() -> prepare("SELECT idCategorie FROM sujet WHERE idSujet = ?");
$requete -> execute([$_POST["getSuj"]]);
$id = $requete -> fetch(PDO::FETCH_ASSOC);

$requete2 = getBdd() -> prepare("SELECT idUser FROM users WHERE idUser = ?");
$requete2 -> execute([$_SESSION["idUser"]]);
$user = $requete2 -> fetch(PDO::FETCH_ASSOC);

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Admin" || $requete2 -> rowCount() > 0 || $user["idUser"] == $_SESSION["idUser"])
{
    if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
    {
       $requete = getBdd() -> prepare("SELECT idSujet FROM sujet WHERE idSujet = ?");
       $requete -> execute([$_POST["getSuj"]]);
       if($requete -> rowCount() > 0)
       {
            if(supprimerSujet($_POST["getSuj"]) == true)
            {
                $idCat = $id["idCategorie"];
                header("location:../pages/index.php?idCategorie=$idCat&success=SujetSuppr");
            }
            else
            {
                header("location:../pages/index.php&idCategorie=$idCat");
            }
       }
       else
       {
        header("location:../pages/index.php&idCategorie=$idCat");
       }
    }
    else
    {
        header("location:../pages/index.php&idCategorie=$idCat");
    }
}
else
{
    header("location:../pages/index.php&idCategorie=$idCat");
}