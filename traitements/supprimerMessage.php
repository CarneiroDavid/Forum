<?php
require_once "../modeles/modeles.php";
$requete = getBdd() -> prepare("SELECT idSujet FROM messages WHERE idMessage = ?");
$requete -> execute([$_POST["getMess"]]);
$idSuj = $requete -> fetch(PDO::FETCH_ASSOC);

if(!empty($_SESSION))
{
    if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
    {
        if(!empty($_POST["getMess"]))
        {
            if(supprimerMessage($_POST["getMess"]) == true)
            {   
                $id = $idSuj["idSujet"];
                header("location:../pages/index.php?idSujet=$id&success=MessageSuppr");
            }
            else
            {
                header("location:../pages/index.php?idSujet=$id");
            }
        }
        else
        {
            header("location:../pages/index.php?idSujet=$id");
        }
    }
    else
    {
        header("location:../pages/index.php?idSujet=$id");
    }
}
else
{
    header("location:../pages/index.php?idSujet=$id");
}