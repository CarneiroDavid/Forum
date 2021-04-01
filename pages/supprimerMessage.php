<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT idMessage, msg, idSujet FROM messages WHERE idMessage = ? ");
$requete -> execute([$_GET["idMessage"]]);
$msg = $requete -> fetch(PDO::FETCH_ASSOC);

?>
<form method="post" action="../traitements/supprimerMessage.php">
    <h1 style="text-align:center;">Voulez-vous vraiment supprimer votre message ? "<?=$msg["msg"];?>"</h1>
    <div class="form-group" style="display:none;">
        <label for="getMess"></label>
        <input type="text" class="form-control" value="<?=$msg['idMessage'];?>" name="getMess" id="getMess"/>
    </div>
    <div class="form-group text-center"> 
            <button type="submit" name="bouton" value="1" class="btn btn-danger">Oui</button>
            <a class="btn btn-primary" href="index.php?idSujet=<?=$msg["idSujet"];?>">Non</a>
    </div>
</form>