<?php
require_once "../modeles/modeles.php";
$requete = getBdd() -> prepare("SELECT idSujet, idMessage FROM messages WHERE idMessage = ?");
$requete -> execute([$_POST["idMess"]]);
$id = $requete -> fetch(PDO::FETCH_ASSOC);
$ID = $id["idMessage"];

if(!empty($_POST["bouton"]) && $_POST["bouton"] == 1)
{
    if(!empty($_POST["modifMess"]) && !empty($_POST["idMess"]))
    {
       if(strlen($_POST["modifMess"]) >= 4)
       {
            if(strlen($_POST["modifMess"]) <= 350)
            {
                if(modifierMessage($_POST["modifMess"], $_POST["idMess"], $_SESSION["idUser"]) == true)
                {
                    $idSuj = $id["idSujet"];
                    header("location:../pages/index.php?idSujet=$idSuj&success=ModifMessage");
                }
                else
                {
                    header("location:../pages/modifierMessage.php?idMessage=$ID&error=ErreurModif");
                }
            }
            else
            {
                header("location:../pages/modifierMessage.php?idMessage=$ID&error=MessageLong");

            }
       }
       else
       {
        header("location:../pages/modifierMessage.php?idMessage=$ID&error=MessageCourt");

       }
    }
    else
    {
        header("location:../pages/modifierMessage.php?idMessage=$ID&error=MessageVide");
    }
}
else
{
    header("location:../pages/modifierMessage.php?idMessage=$ID&error=Erreur");
}
