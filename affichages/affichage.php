<?php
require_once "../modeles/modeles.php";

function afficherCategorie()
{
    $requete = getBdd() -> prepare("SELECT idCategorie, nom FROM categories");
    $requete -> execute();
    $categories = $requete -> fetchAll(PDO::FETCH_ASSOC);

    foreach($categories as $categorie)
    {
        ?>
        <li class="list-group-item" style="text-align:center;font-size:150%;" onclick="window.location.href='../pages/index.php?idCategorie=<?=$categorie['idCategorie'];?>'">
                <a href="index.php?idCategorie=<?=$categorie["idCategorie"]?>" style="text-decoration:none;"><?=$categorie["nom"]?></a>
        </li>
        <?php
    }
}

function afficherSujet($idSujet)
{
    $requete = getBdd() -> prepare("SELECT sujet.idUser,idSujet, idCategorie, sujet.nom, sujet.msg as msg, sujet.pseudo as pseudo, pdp , statut FROM sujet INNER JOIN users USING(idUser) WHERE idSujet = ?");
    $requete -> execute([$idSujet]);
    $msg = $requete -> fetch(PDO::FETCH_ASSOC);

    $requete2 = getBdd() -> prepare("SELECT  idMessage, users.idUser, msg, pseudo, pdp, statut FROM messages INNER JOIN users USING(idUser) WHERE idSujet = ?");
    $requete2 ->execute([$idSujet]);
    $allMsg = $requete2 -> fetchAll(PDO::FETCH_ASSOC);
    print_r($allMsg);
    if(!empty($_SESSION["idUser"]))
    {
        $requete = getBdd() -> prepare("SELECT *FROM moderateurs WHERE idCategorie = ? AND idUser = ?");
        $requete -> execute([$msg["idCategorie"], $_SESSION["idUser"]]);
    }
    ?>
    <div class="row">
        <div class="col md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;"><?=$msg["nom"];?></h5>

                    <div class="row">
                        <div class="col md-4">
                            <div class="card">
                                <div class="card-body" style="padding-left:1%">
                                        
                                    <div style="float:left;width: 15%; margin-right: 1%;height: 200px;padding-left: 1%;">
                                    <div style="border: solid;border-radius: 10%; max-width: 70%;min-width: 60%;">
                                        <img style="max-width: 100%;border-radius: inherit;" src="<?=!empty($msg["pdp"]) ? $msg["pdp"] : "../image/profil-neutre.jpg";?>"/>
                                    </div>
                                        
                                    <h5 
                                        <?=$msg["statut"] == "Admin" ? "style='color:red'" : "";?>
                                        <?=$msg["statut"] == "Modo" ? "style='color:blue'" : "";?>
                                        ><?=$msg["pseudo"];?>
                                    </h5>
                                    </div>
                                        
                                        <div style="border:2px ridge;border-radius:1%;margin-left: 13%;width: 83%;height: 200px;overflow-y: scroll;">
                                        <p style="position:relative;margin:1%"><?=$msg["msg"];?> </p>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                    <?php
                                        if(!empty($_SESSION["idUser"]))
                                        {
                                            if($requete -> rowCount() > 0 || $msg["idUser"] == $_SESSION["idUser"] || $_SESSION["statut"] == "Admin")
                                            {
                                                ?>
                                            <a class="btn btn-warning" href="modifierSujet.php?idSujet=<?=$msg['idSujet'];?>">Modifier</a>
                                            <a class="btn btn-danger" href="supprimerSujet.php?idSujet=<?=$msg['idSujet'];?>">Supprimer</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                                    </div>
                                </div>
                            </div><hr>
                            <?php
                            foreach($allMsg as $Msg)
                            {
                                ?>
                                <div class="row">
                            <div class="col md-4">
                                <div class="card">
                                    <div class="card-body" style="padding-left:1%">
                                        
                                        <div style="float:left;width: 15%; margin-right: 1%;height: 200px;padding-left: 1%;">
                                        <div style="border: solid;border-radius: 10%; max-width: 60%;min-width: 60%;">
                                        <img style="width: 100%;border-radius: inherit;" src="<?=!empty($Msg["pdp"]) ? $Msg["pdp"] : "../image/profil-neutre.jpg";?>"/>
                                        </div>
                                        <h5 
                                        <?=$Msg["statut"] == "Admin" ? "style='color:red'" : "";?>
                                        <?=$Msg["statut"] == "Modo" ? "style='color:blue'" : "";?>
                                        ><?=$Msg["pseudo"];?></h5>
                                        </div>

                                        <div style="border-style: ridge;margin-left: 13%;width: 83%;height: 200px;overflow-y: scroll;">
                                        <p style="position:relative;margin:1%"><?=$Msg["msg"];?> </p>
                                        </div>


                                        <?php if(!empty($_SESSION["idUser"])){ ?>
                                        <div class="form-group text-center">
                                            <?php
                                            if($requete -> rowCount() > 0 || $Msg["idUser"] == $_SESSION["idUser"] || $_SESSION["statut"] == "Admin")
                                            {
                                                
                                                ?>
                                                <a class="btn btn-warning" href="modifierMessage.php?idMessage=<?=$Msg['idMessage'];?>">Modifier</a>
                                                <a class="btn btn-danger" href="supprimerMessage.php?idMessage=<?=$Msg['idMessage'];?>">Supprimer</a>
                                                <?php
                                            }
                                                ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                                <?php
                            }
                            ?>         
                        </div>
                    </div>
                </div>
            </div>

                <?php
}

function afficherProfil($idUser)
{
   
    $requete = getBdd() -> prepare("SELECT pseudo, nom, prenom, email, pdp, dateNaiss, statut FROM users WHERE idUser = ? ");
    $requete -> execute([$idUser]);
    $infos = $requete -> fetch(PDO::FETCH_ASSOC);
    
    extract($infos);
 ?>

    <br><div class="container">
        <div style="border: solid; border-radius: 10%; max-width: 20%;">
            <img style="max-width: 100%;border-radius: inherit;" src="<?=!empty($pdp) ? $pdp : "../image/profil-neutre.jpg";?>"/>
        </div><br>
        <h4>[<?=$statut;?>]<?=$pseudo;?></h4>
        <h5><?=$nom." ".$prenom;?></h5>
        <p><?=$email;?></p>
        <p><?=$dateNaiss;?></p>

        <a href="profil.php?modifUser=<?=$idUser;?>" class="btn btn-primary">Modifier</a><br><br>
    </div><br>
    <?php
}


function modifierProfil($idUser)
{
    $requete = getBdd() -> prepare("SELECT pseudo, nom, prenom, email, pdp, dateNaiss, statut FROM users WHERE idUser = ? ");
    $requete -> execute([$idUser]);
    $infos = $requete -> fetch(PDO::FETCH_ASSOC);
    
    extract($infos);

    ?><br><div class="container">
        <div style="border: solid; border-radius: 10%; max-width: 20%;">
            <img style="max-width:100%;border-radius: inherit;" src="<?=!empty($pdp) ? $pdp : "../image/profil-neutre.jpg";?>"/>
        </div><br>

        <form method="POST" enctype="multipart/form-data" action="../traitements/UploadImage.php">
            <div class="form-group">
            <label for="image">Selectionner une image</label>
            <input type="file" name="image">
            <br>
            <button type="submit" name="envoiModif" class="btn btn-primary" value="1">Envoyer l'image</button>
            </div>
        </form><br>

        <form method="post" action="../traitements/modifProfil.php">
            <h4>
                [<?=$statut;?>]
                <input type="text" name="modifPseudo" value="<?=$pseudo;?>"/></input>
            </h4>

            <h5><?=$nom." ".$prenom;?></h5>

            <input type="text" name="modifEmail" value="<?=$email;?>"/></input>

            <p><?=$dateNaiss;?></p>
            <input style="display:none" name="idUser" value="<?=$_GET['modifUser'];?>">
            <button type="submit" value="1" name="valideModif" class="btn btn-primary">Valider Info</button><br><br>
        </form>
    </div><br>
    <?php
}

function afficherSujets($idCat)
{
    $requete = getBdd() -> prepare("SELECT idSujet, sujet.nom, .users.pseudo,pdp, statut FROM sujet INNER JOIN users USING(idUser) WHERE idCategorie = ?");
    $requete -> execute([$idCat]);
    $sujets = $requete -> fetchAll(PDO::FETCH_ASSOC);

    foreach($sujets as $sujet)
    {
        ?>
        <li class="list-group-item"  onclick="window.location.href='../pages/index.php?idSujet=<?=$sujet['idSujet'];?>'">

            <div style="border: solid; border-radius: 10%; max-width: 7%;">
                <img style="max-width: 100%;border-radius: inherit;" src="<?=!empty($sujet["pdp"]) ? $sujet["pdp"] : "../image/profil-neutre.jpg";?>"/>
            </div>
            <div
            <?=$sujet["statut"] == "Admin" ? "style='color:red;display:inline-block;'" : "";?>
            <?=$sujet["statut"] == "Modo" ? "style='color:blue;display:inline-block;'" : "";?>>
            [<?=$sujet["statut"];?>]
            <?=$sujet["pseudo"];?>
            </div>
            <span style="float:right;">              
            <a href="index.php?idSujet=<?=$sujet["idSujet"]?>"><?=$sujet["nom"]?></a>
            </span>
        </li>
        <?php
    }
}

