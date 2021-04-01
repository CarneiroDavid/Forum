<?php
require_once "../modeles/modeles.php";
$requete = getBdd() -> prepare("SELECT idSujet FROM sujet WHERE idSujet = ?");
$requete -> execute([$_POST["idSujet"]]);
$idSuj = $requete -> fetch(PDO::FETCH_ASSOC);
$id = $idSuj["idSujet"];
if(!empty($_POST["valideCom"]) && $_POST["valideCom"] == 1)
{
    if(!empty($_SESSION["pseudo"]))
    {
        if(!empty($_POST["commentaire"]))
        {
            if(strlen($_POST["commentaire"]) < 350)
            {
                if(insertionMessage($_SESSION["idUser"], $_POST["commentaire"], $_POST["idSujet"]) == true)
                {
                    
                    header("location:../pages/index.php?idSujet=$id&success=Message");
                }
                else
                {
                    header("location:../pages/index.php?idSujet=$id&erreurs=Message");
                }
            }else{
                header("location:../pages/index.php?idSujet=$id&erreurs=lenComment");
            }
        }
        else
        {
            header("location:../pages/index.php?idSujet=$id&erreurs=MessVide");
        }
    }
    else
    {
        header("location:../pages/index.php?idSujet=$id&erreurs=UserDeco");
    }
}
else
{
    header("location:../pages/index.php?idSujet=$id&erreurs=FormulaireVide");
}
?>
