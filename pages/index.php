<?php 
require_once "entete.php";
require_once "../affichages/affichage.php";

?>


<div class="container">
<?php

if(!empty($_GET["erreurs"]))
            {
                ?>
            <div class="alert alert-danger" style="text-align:center;">
            <?php
    
            switch($_GET["erreurs"])
            {
                case "FormulaireVide":
                    echo "le formulaire envoyé est vide";
                    break;
                case "SujetNomVide":
                    echo "Soit le contenue du sujet ou le titre du sujet est vide";
                    break;
                case "TailleSujetNom":
                    echo "le contenu du sujet doit être inférieur a 1000 caractères et le nom doit être inférieur a 100 caractères";
                    break;
                case "Sujet" :
                    echo "Le sujet n'a pas pu être enregistré";
                    break;
                case "UserDeco":
                    echo "Vous devez être connecté pour poster un commentaire";
                    break;
                case "MessVide":
                    echo "Le commentaire envoyé est vide";
                    break;
                case "lenComment":
                    echo "Le commentaire doit être inférieur a 300 caractères";
                    break;
                case "Message":
                    echo "Le commentaire n'a pas pu être enregistré";
                    break;
            }
            ?>
            </div>
            <?php
            }
if(!empty($_GET["success"]))
            {
                ?>
            <div class="alert alert-success" style="text-align:center;">
            <?php
    
            switch($_GET["success"])
            {
                case "MessageSuppr":
                    echo "Votre message a bien été supprimé";
                    break;
                case "SujetSuppr":
                    echo "Le sujet a bien été supprimé";
                    break;
                case "Message":
                    echo "Votre message a bien été enregistré";
                    break;
                case "SujetModif" :
                    echo "Le sujet a bien été modifié";
                    break;
                case "ModifMessage":
                    echo "Votre message a bien été modifé";
                    break;
            }
            ?>
            </div>
            <?php
            }
/////////////// AFFICHAGE Liste des Categories //////////////////////


        if(empty($_GET["idCategorie"]) && empty($_GET["idSujet"]))
        {
            ?><h1 style="text-align:center;">Categories</h1>
            <br>
            <?php
            afficherCategorie();
        }

/////////////// AFFICHAGE Liste des Sujets     //////////////////////


        if(!empty($_GET["idCategorie"]) && empty($_GET["idSujet"]))
        {
            ?><h1 style="text-align:center;">Sujet</h1>
            <?php
            afficherSujets($_GET["idCategorie"]);
            ?>
            
            <?php
            if(!empty($_SESSION["pseudo"]))
            {

               
            ?>
                <hr>
                <form method="post" action="../traitements/ajouterSujet.php">
                    <div class="form-group" >
                        <label for="creerSujet">Nom du sujet</label>
                        <input type="text" class="form-control" name="creerSujet"/>
                        <input type="text" style="display:none;" class="form-control" name="idCategorie" value="<?=$_GET["idCategorie"];?>"/>
                        <label for="contenuSujet">Contenu du sujet</label>
                        <textarea type="text" class="form-control" name="contenuSujet"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="envoiSujet" value="1" class="btn btn-primary">Créer le sujet</button>
                    </div>
                </form>
            
           
            <?php
            }
        }

        
/////////////// AFFICHAGE       du Sujet       //////////////////////       
        if(!empty($_GET["idSujet"]))
        {   
            AfficherSujet($_GET["idSujet"]);

     /////////////////////////////////////////////////////////////////////
                if(!empty($_SESSION["pseudo"]))
                {

                
                ?>
                <br>
                <form method="post" action="../traitements/VerifMessage.php">
                    <div class="form-group">
                        <label for="commentaire">Écrire un commentaire</label>
                        <input type="text" class="form-control" name="commentaire"/>
                        <input type="text" style="display:none;" class="form-control" name="idSujet" value="<?=$_GET["idSujet"];?>"/>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="valideCom" value="1" class="btn btn-primary">Valider le commentaire</button>
                    </div>
                </form>
                
                <?php
                }
        }
               
        
    ?>


</div>


<?php
require_once "pied.php";
?>