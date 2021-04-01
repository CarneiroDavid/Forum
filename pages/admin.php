<?php
require_once "entete.php";

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Admin")
{

    if(!empty($_GET["suppr"]))
    {
        supprimerCategorie($_GET["suppr"]);
    }
    ?>
    <?php
    if(!empty($_GET["erreurs"])){
    ?>
            <div class="alert alert-danger mt-3" style="text-align: center">
                <?php switch($_GET["erreurs"]){
                    case "TailleCat":
                        echo "Le nom de la catégorie doit etre compris entre 4 et 35 caractères";
                        break;
                    case "ajoutCat":
                        echo "La catégorie n'a pas pu être ajoutée";
                        break;
                    case "modifCat":
                        echo "La catégorie n'a pas pu être modifiée";
                        break;
                    case "supprCat":
                        echo "La categorie n'a pas pu être supprimée";
                        break;
                    case "vide":
                        echo "Le formulaire envoyé est vide";
                        break;
                    case "modifUser":
                        echo "L'utilisateur n'a pas pu etre modifié";
                        break;
                    case "AdressMail":
                        echo "L'adresse mail saisit n'est pas valide";
                        break;
                    case "StrlenVar":
                        echo "le pseudo, le nom, et le prenom doivent faire 20 caractères ou moins";
                        break;
                    case "VarVide":
                        echo "Un des champs est vide";
                        break;
                    case "FormulaireVide":
                        echo "Le formulaire est vide";
                        break;
                    case "SectionNULL":
                        echo "La Section selectionné n'existe pas";
                        break;
                    default:
                        echo $_GET["erreurs"]; 
                        break;
                }
                ?>
            </div>
    <?php
    }
    ?>
    <?php
    if(!empty($_GET["success"])){
    ?>
            <div class="alert alert-success mt-3" style="text-align: center">
                <?php switch($_GET["success"]){
                    case "ajoutCat":
                        echo "La catégorie a bien été créée";
                        break;
                    case "modifCat":
                        echo "La catégorie a bien été modifiée";
                        break;
                    case "supprCat":
                        echo "La categorie a bien été supprimée";
                        break;
                    case "modifUser":
                        echo "L'utilisateur a bien été modifié";
                        break;
                    case "AjoutUser":
                        echo "L'utilisateur a bien été créé";
                        break;
                    case "supprCat":
                        echo "La catégorie a bien été supprimé";
                        break;
                }
                ?>
            </div>

    <?php
    }
    $requete = getBdd() -> prepare("SELECT * FROM categories");
    $requete -> execute();
    $categories = $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <?php
    foreach($categories as $categorie)
    {
        ?>
        <li class="list-group-item"><?=$categorie["nom"]?>
            <span style="float:right">
                <a class="btn btn-warning btn-sm" href="admin.php?idCat=<?=$categorie["idCategorie"]?>">Modifier</a>
                <a class="btn btn-danger btn-sm" href="admin.php?suppr=<?=$categorie["idCategorie"]?>">Supprimer</a>
            </span>
        </li>
        <?php
    }
    if(isset($_GET["idCat"]) && !empty($_GET["idCat"]))
    {
        $requete = getBdd() -> prepare ("SELECT nom FROM categories WHERE idCategorie = ?");
        $requete -> execute([$_GET["idCat"]]);
        $categorie = $requete -> fetch(PDO::FETCH_ASSOC);
        ?>
        <br>
        <form method="post" action="../traitements/modifierCategorie.php">
            <div class="form-group">
                <label for="modifCat">Modifier une catégorie</label>
                <input type="text" class="form-control" value="<?=$categorie["nom"];?>" name="modifCat"/>
                <input type="text" style="display:none;" class="form-control" value="<?=$_GET["idCat"];?>" name="idModif"/>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="envoiModif" value="1" class="btn btn-primary">Modifier la catégorie</button>
            </div>
        </form>
        <?php
     
    }else
    {
        ?>
        <br>
        <form method="post" action="../traitements/AjouterCategories.php">
            <div class="form-group">
                <label for="ajoutCat">Ajouter une catégorie</label>
                <input type="text" class="form-control" name="ajoutCat"/>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="envoiCat" value="1" class="btn btn-primary">Ajouter la catégorie</button>
            </div>
        </form>
        <?php
    }

    $requete = getBdd() -> prepare("SELECT idUser,users.pseudo,statut FROM users ORDER BY statut");
    $requete -> execute();
    $users = $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <form method="post" action="admin.php">
        <div class="form-group">
            <label for="listUser">Liste des utilisateurs :</label>
            <select name="listUser" class="form-control">
            <?php

            foreach($users as $user)
            {
                ?>
                <option value="<?=$user["idUser"];?>"><?=$user["idUser"]." "."[".$user["statut"]."] ".$user["pseudo"]?></option>
                <?php
            }
            ?>
            </select>
        </div>
        <div class="form-group text-center">
            <button type="submit" name="envoiModif" value="1" class="btn btn-primary">Go</button>
            <a href="creationUser.php" class="btn btn-success">Créer Utilisateur</a>
        </div>

    </form>
<?php

if(!empty($_POST["listUser"]) || !empty($_GET["modifUser"])){
    $requete= getBdd()->prepare("SELECT idUser,email,nom,prenom,pseudo,dateNaiss,pdp,statut FROM users WHERE idUser = ?");
    if(!empty($_POST["listUser"])){
    $requete->execute([$_POST["listUser"]]);
    }
    if(!empty($_GET["modifUser"])){
        $requete->execute([$_GET["modifUser"]]);
    }

    $user = $requete->fetch(PDO::FETCH_ASSOC);
    
    extract($user);
    print_r($user);
    if(!empty($_GET["modifUser"]))
    {
        ?>
           
        <div class="card mr-auto" style="width: 18rem;">
            <img class="card-img-top" src="<?=!empty($pdp) ? $pdp : "../image/profil-neutre.jpg";?>" alt="photo de profil vide">
            <div class="card-body">
                <h5 class="card-title">
                     <?php $requete= getBdd()->prepare("SELECT idStatut, statut FROM statuts");
                        $requete->execute();
                        $listestatut = $requete->fetchALL(PDO::FETCH_ASSOC);
                        ?>
                <form method='post' action="../traitements/modifUser.php">
                    <label for="modifStatut">Statut :</label>
                    <select name="modifStatut"class="form-control">
                        <?php
                            
                        foreach($listestatut as $X){
                            ?>
                            <option value="<?=$X["statut"];?>"  <?=$statut == $X["statut"] ? "selected":"";?> ><?=$X["statut"];?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label for="modifPseudo">Pseudo :</label>
                    <input name="modifPseudo" value="<?=$pseudo;?>" class="form-control"/></h5>
                    <h6>
                        <?php
                        if($statut == "Modo")
                        {
                            $requete= getBdd()->prepare("SELECT idCategorie,nom,idUser from moderateurs RIGHT JOIN categories USING(idCategorie)");
                            $requete->execute();
                            $sections = $requete->fetchALL(PDO::FETCH_ASSOC);
                            ?>
                            
                            <label for='modifSection'>Section :</label>
                            <select class='form-group' name="modifSection">";
                            <?php
                            foreach($sections as $section)
                                {
                                ?>
                                <option <?= $section["idUser"] == $_GET['modifUser'] ? "selected":"";?> value="<?=$section['idCategorie'];?>" class="form-control"><?=$section['nom'];?></option>
                                <?php
                                }
                                ?>
                                </select>
                                <?php
                            
                            
                        }
                        ?>
                        
                        <br>
                        <label for="modifNom">Nom :</label>
                        <input name="modifNom" value="<?=$nom;?>" class="form-control" />
                        <label for="modifPrenom">Prenom :</label>
                        <input name="modifPrenom" value="<?=$prenom;?>" class="form-control" />
                    </h6>
                    <h6>
                        <label for="modifEmail">Adresse Email :</label>
                        <input name="modifEmail" value="<?=$email;?>" class="form-control" />
                    </h6>
                    <h6>Date de naissance : <?=$dateNaiss;?></h6>
                    <input value="<?=$_GET["modifUser"];?>" name="idUser" style="display:none"></input>
                    <button type='submit' name="EnvoiModif" class="btn btn-warning" value="1">Enregistrer</a>
                </form>
            </div>
        </div>
        <?php
        
    
    }else{
        ?>
        <div class="card mr-auto" style="width: 18rem;">
            <img class="card-img-top" src="<?=!empty($pdp) ? $pdp : "../image/profil-neutre.jpg";?>" alt="photo de profil vide">
            <div class="card-body">
                <h5 class="card-title"><?="[".$statut."] ".$pseudo;?></h5>
                <?php
                if($statut == "Modo")
                        {
                            $requete= getBdd()->prepare("SELECT idCategorie,nom,idUser from moderateurs RIGHT JOIN categories USING(idCategorie) WHERE idUser = ?");
                            $requete->execute([$_POST["listUser"]]);
                            $section = $requete->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <h6>Section : <?=$section["nom"];?></h6>  
                            <?php
                        }
                ?>

                
                <h6><?=$nom." ".$prenom;?></h6>
                <h6><?=$email;?></h6>
                <h6><?=$dateNaiss;?></h6>
                
                <a href="admin.php?modifUser=<?=$idUser;?>" class="btn btn-warning">Modifier Utilisateur</a>
                <a href="../pages/supprimerUtilisateur.php?idUser=<?=$idUser;?>" class="btn btn-danger">Supprimer Utilisateur</a>
            </div>
        </div>
        <?php
    }
}



}else{
    ?>
    <div class="alert alert-danger mt-3">
    Erreur<br>
</div>
<?php
}

?>