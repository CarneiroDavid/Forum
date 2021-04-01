<?php
require_once "entete.php";
if($_SESSION["statut"]){
    
    if(!empty($_GET["erreurs"])){
    ?>
            <div class="alert alert-danger mt-3">
                <?php switch($_GET["erreurs"])
                {
                    case "vide":
                        echo "Le formulaire envoyé est vide";
                        break;
                    case "AdressMail":
                        echo "L'adresse mail saisit n'est pas valide";
                        break;
                    case "prenomTaille":
                        echo "le prenom doit faire 20 caractères ou moins";
                        break;
                    case "pseudoTaille":
                        echo "le pseudo doit faire 20 caractères ou moins";
                        break;
                    case "idTaille":
                        echo "l'identifiant' doit faire 20 caractères ou moins";
                        break;
                    case "nomTaille":
                        echo "le nom doit faire 20 caractères ou moins";
                        break;
                    case "mdpTaille":
                        echo "le mot de passe doit faire 20 caractères ou moins";
                        break;
                    case "VarVide":
                        echo "Un des champs est vide";
                        break;
                    case "FormulaireVide":
                        echo "La formulaire est vide";
                        break;
                    case "uniqueIdentifiant":
                        echo "L'identifiant saisit est déjà utilisé";
                        break;
                    case "uniqueMail":
                        echo "L'adresse mail saisit est déjà utilisé";
                        break;
                    case "uniquePseudo":
                        echo "Le pseudo saisit est déjà utilisé";
                        break;
                    default:
                        echo $_GET["erreurs"]; 
                        break;
                }
            echo "</div>";
    }

?>

<h2>Inscription</h2>

<form method="post" action="../traitements/ajoutUser.php">
    <div class="form-group">
        <label for="identifiant">Identifiant</label>
        <input type="text" class="form-control" name="identifiant" id="identifiant" required/>
    </div>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom"  required/>
    </div>

    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" required/>
    </div>

    <div class="form-group">
        <label for="dateNaiss">Date de naissance</label>
        <input type="date" class="form-control" name="dateNaiss" id="dateNaiss"  required/>
    </div>

    <div class="form-group">
        <label for="email">Adresse mail</label>
        <input type="text" class="form-control" name="email" id="email" required/>
    </div>
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo"  required/>
    </div>
    <?php $requete= getBdd()->prepare("SELECT idStatut, statut FROM statuts");
        $requete->execute();
        $listestatut = $requete->fetchALL(PDO::FETCH_ASSOC);
    ?>
                
    <label for="statut">Statut :</label>
    <select name="statut"class="form-control">
        <?php    
            foreach($listestatut as $X)
            {
        ?>
                <option value="<?=$X["statut"];?>"><?=$X["statut"];?></option>
        <?php
            }
        ?>
        </select>
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
}else{
    header("location:index.php");
}

require_once "pied.php";
?>