<?php
require_once "entete.php";

if(!empty($_GET["error"]))
{
    ?>
    <div class="alert alert-danger" style="text-align:center;">
    <?php
    switch($_GET["error"])
    {
        case "formNonEnvoyer":
            echo "Erreur de d'inscription, veuillez reessayer";
            break;
        case "champVide":
            echo "Veillez à ce que tous les champs soient renseigné";
            break;
        case "champLong":
            echo "L'un des champ saisit est trop long, veuillez saisir des informations plus courtes";
            break;
        case "dateNaissInvalide":
            echo "Votre âge ne vous permet pas de vous inscrire";
            break;
        case "emailInvalide":
            echo "Votre email est invalide";
            break;
        case "emailIncorrect":
            echo "Cet adresse email existe déjà";
            break;
        case "identifiantIncorrect":
            echo "L'identifiant saisit est déjà utilisé, veuillez en saisir un autre";
            break;
        case "MdpIncorrect":
            echo "Les deux mots de passes saisit ne sont pas identique";
            break;
        case "erreurInscription":
            echo "erreur";
            break;
        case "test":
            echo "testErreur";
            break;
    }
    ?>
    </div>
    <?php
}
?>

<h2>Inscription</h2>

<form method="post" action="../traitements/verifInscription">
    <div class="form-group">
        <label for="identifiant">Identifiant</label>
        <input type="text" class="form-control" name="identifiant" id="identifiant" value="<?=isset($_POST["identifiant"]) ? $_POST["identifiant"] : ""?>" required/>
    </div>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?=isset($_POST["nom"]) ? $_POST["prenom"] : ""?>" required/>
    </div>

    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?=isset($_POST["prenom"]) ? $_POST["prenom"] : ""?>" required/>
    </div>

    <div class="form-group">
        <label for="dateNaiss">Date de naissance</label>
        <input type="date" class="form-control" name="dateNaiss" id="dateNaiss" value="<?=isset($_POST["dateNaiss"]) ? $_POST["dateNaiss"] : ""?>" required/>
    </div>

    <div class="form-group">
        <label for="email">Adresse mail</label>
        <input type="text" class="form-control" name="email" id="email" value="<?=isset($_POST["email"]) ? $_POST["email"] : ""?>" required/>
    </div>
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?=isset($_POST["pseudo"]) ? $_POST["pseudo"] : ""?>" required/>
    </div>
    
    <div class="form-group">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" name="mdp" id="mdp" required/>
    </div>
    <div class="form-group">
        <label for="mdp2">Verification Mot de passe</label>
        <input type="password" class="form-control" name="mdp2" id="mdp2" required/>
    </div><br>
    <div class="form-group text-center"> 
        <button type="submit" name="bouton" value="1" class="btn btn-primary">Valider les informations</button>
    </div>
</form>
<?php
require_once "pied.php";
?>