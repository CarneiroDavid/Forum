<?php


function insertionMessage($idUser, $commentaire, $idSuj)
{
    $commentaire = htmlspecialchars($commentaire, ENT_QUOTES);
    $erreurs = [];
    // echo $idUser." ".$commentaire." ".$idSuj;exit;
    $requete = getBdd() -> prepare("SELECT idSujet FROM sujet WHERE idSujet = ?");
    $requete -> execute([$idSuj]);
    if($requete -> rowCount() == 0)
    {
        $erreurs[] = "La sujet n'existe pas"; 
    }

    if(count($erreurs) == 0)
    {
         
        try{
            $requete = getBdd() -> prepare("INSERT INTO messages (idUser, msg, idSujet) VALUES(?, ?, ?)");
            $requete -> execute([$idUser, $commentaire, $idSuj]);
            return true;       
        }catch(Exception $e)
        {
            header("location:../pages/index.php?error=erreurInjection");
        }
    }else 
    {
        header("location:../:pages/index.php?error=SujetInconnu");
    }
}

function modifierMessage($message, $idMess, $idUser)
{
    $message = htmlspecialchars($message, ENT_QUOTES);
    try 
    {
        $requete = getBdd() -> prepare("UPDATE messages SET msg = ? WHERE idMessage = ?");
        $requete -> execute([$message, $idMess]);
        return true;
    }
    catch(Exception $e)
    {
        echo $e -> getMessage();
        // header("location:../pages/index.php?error=erreurModif");
    }
}

function supprimerMessage($idMess)
{
    $requete = getBdd() -> prepare("DELETE FROM messages WHERE idMessage = ?");
    $requete -> execute([$idMess]);
    return true;

}