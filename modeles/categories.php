<?php


function ajouterCategorie($nom)
{   
    $nom = htmlspecialchars($nom, ENT_QUOTES);
    if(!empty($nom))
    {
        try{
            $requete = getBdd() -> prepare("INSERT INTO categories (nom) VALUES(?)");
            $requete -> execute([$nom]);
            return true;

        }catch(Exception $e)
        {
            return false;
        }
    }
}

function modifierCategorie($id, $nom)
{
    $nom = htmlspecialchars($nom, ENT_QUOTES);
    $requete = getBdd() -> prepare("SELECT idCategorie FROM categories WHERE idCategorie = ?");
    $requete -> execute([$id]);
    if($requete -> rowCount() == 0)
    {
      header("location:../pages/admin.php?erreurs=noCat");
    }

    if(!empty($nom))
    {
        try
        {
            $requete = getBdd() -> prepare ("UPDATE categories SET nom = ? WHERE idCategorie = ?");
            $requete -> execute([$nom, $id]);
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}

function supprimerCategorie($id)
{
    try{
    $requete = getBdd() -> prepare("DELETE FROM categories WHERE idCategorie = ?");
    $requete -> execute([$id]);
    header("location:../pages/admin.php?success=supprCat");
    }catch(Exception $e){
        header("location:../pages/admin.php?erreurs=supprCat");
    }
}