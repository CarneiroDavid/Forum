<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT idMessage, idSujet, msg FROM messages WHERE idMessage = ? ");
$requete -> execute([$_GET["idMessage"]]);
$mess = $requete -> fetch(PDO::FETCH_ASSOC);
if(!empty($_GET["error"]))
{
    ?>
    <div class="alert alert-danger" style="text-align:center;">
    <?php
    switch($_GET["error"])
    {
        case "Erreur":
            echo "Une erreur sur le formulaire est survenue, veuillez réessayer";
            break;
        case "MessageVide":
            echo "Le message saisit ne doit pas être vide, veuillez en saisir un plus long";
            break;
        case "MessageCourt":
            echo "Le message saisit est trop court, veuillez en saisir un plus long";
            break;
        case "MessageLong":
            echo "Le message saisit est trop long, veuillez en saisir un plus court";
            break;
        case "ErreurModif":
            echo "Une erreur est survenue lors de la modification, veuillez réessayer";
            break;
    }
    ?>
    </div>
    <?php
}
?>

<form method="post" action="../traitements/modifierMessage.php">

    <div class="form-group">
        <label for="modifMess">Message</label>
        <input type="text" class="form-control" value="<?=$mess['msg'];?>" name="modifMess" id="modifMess"/>
    </div>
    <div class="form-group" style="display:none;">
        <label for="idMess"></label>
        <input type="text" class="form-control" value="<?=$_GET["idMessage"];?>" name="idMess" id="idMess"/>
    </div>

    <div class="form-group text-center"> 
        <button type="submit" name="bouton" value="1" class="btn">Modifier</button>
    </div>
</form>