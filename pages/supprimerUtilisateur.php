<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT pseudo, idUser FROM users WHERE idUser = ? ");
$requete -> execute([$_GET["idUser"]]);
$user = $requete -> fetch(PDO::FETCH_ASSOC);

?>
<form method="post" action="../traitements/supprimerUtilisateur.php">
    <h1 style="text-align:center;">Voulez-vous vraiment supprimer l'utilisateur <?=$user["pseudo"];?></h1>
    <div class="form-group" style="display:none;">
        <label for="idUser"></label>
        <input type="text" class="form-control" value="<?=$user['idUser'];?>" name="idUser" id="idUser"/>
    </div>
    <div class="form-group text-center"> 
            <button type="submit" name="bouton" value="1" class="btn btn-danger">Oui</button>
            <a class="btn btn-primary" href="admin.php">Non</a>
    </div>
</form>