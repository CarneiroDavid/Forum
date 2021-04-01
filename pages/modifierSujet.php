<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT idSujet, nom, msg FROM sujet WHERE idSujet = ? ");
$requete -> execute([$_GET["idSujet"]]);
$suj = $requete -> fetch(PDO::FETCH_ASSOC);

if(!empty($_GET["error"]))
{
    ?>
    <div class="alert alert-danger" style="text-align:center;">
    <?php
    switch($_GET["error"])
    {
        case "Erreur":
            echo "Erreur de modification";
            break;
        case "TitreMessVide":
            echo "Le Message ou le titre est vide, veuillez renseigner tous les champs disponibles";
            break;
        case "TitreCourt":
            echo "Le titre est trop court";
            break;
        case "TitreLong":
            echo "Le titre est trop long";
            break;
        case "MessageCourt":
            echo "Le message saisit est trop court";
            break;
        case "MessageLong":
            echo "Le message saisit est trop long";
            break;
        case "ModifProbleme":
            echo "Un problème est survenue lors de la modification, veuillez réessayer";
            break;
    }
    ?>    
    </div>
    <?php
}
?>
<form method="post" action="../traitements/modifierSujet.php">
            <div class="form-group">
                <label for="modifTitre">Titre</label>
                <input type="text" class="form-control" value="<?=$suj['nom'];?>" name="modifTitre" id="modifTitre"/>
            </div>
            <div class="form-group" style="display:none;">
                <label for="getSuj">Titre</label>
                <input type="text" class="form-control" value="<?=$suj['idSujet'];?>" name="getSuj" id="getSuj"/>
            </div>
            <div class="form-group">
                <label for="modifSuj">Message Principal</label>
                <input type="text" class="form-control" value="<?=$suj['msg'];?>" name="modifSuj" id="modifSuj"/>
            </div>

            <div class="form-group text-center"> 
                <button type="submit" name="bouton" value="1" class="btn">Modifier</button>
            </div>
        </form>