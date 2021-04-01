<?php
require_once 'entete.php';

if(!empty($_GET["error"]))
{
    ?>
    <div class="alert alert-danger" style="text-align:center;">
    <?php
    switch($_GET["error"])
    {
        case "Inscription":
            echo "Erreur de connexion, veuillez reessayer";
            break;
        case "IdMdpVide":
            echo "L'un des champs est vide, veillez à ce que les champs soient saisit";
            break;
        case "Mdp":
            echo "Le mot de passe saisit est faux";
            break;
        case "IdFaux":
            echo "L'identifiant n'existe pas";
            break;
        case "Connexion":
            echo "La connexion a echouée, veuillez réessayer";
            break;
    }
    ?>
    </div>
    <?php
}
?>

<div id="accueil">
    <div id="connexion" class="container-xxl">
        <form method="post" action="../traitements/verifConnexion.php">
            <div class="form-group">
                <label for="identifiant">Identifiant</label>
                <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="id"/>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe"/>
            </div>

            <div class="form-group text-center"> 
                <button type="submit" name="bouton" value="1" class="btn">Connexion</button>
            </div>
        </form>
    </div>

</div>


<?php
require_once "pied.php";
?>