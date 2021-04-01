<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT idSujet, nom, msg FROM sujet WHERE idSujet = ? ");
$requete -> execute([$_GET["idSujet"]]);
$suj = $requete -> fetch(PDO::FETCH_ASSOC);

?>
<form method="post" action="../traitements/supprimerSujet.php">
    <h1>Voulez-vous vraiment supprimer la categories <?=$suj["nom"];?></h1>
    <div class="form-group" style="display:none;">
        <label for="getSuj">idSuj</label>
        <input type="text" class="form-control" value="<?=$suj['idSujet'];?>" name="getSuj" id="getSuj"/>
    </div>
    <div class="form-group text-center"> 
            <button type="submit" name="bouton" value="1" class="btn btn-danger">Oui</button>
            <a class="btn btn-primary" href="index.php?idSujet=<?=$suj["idSujet"];?>">Non</a>
    </div>
</form>