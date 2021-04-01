<?php
require_once "../modeles/modeles.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<?php 

    ?>
    <nav>
        <a class="navbar-brand" href="index.php">Accueil</a>
        
        <?php
        if (isset($_SESSION["statut"]) && !empty($_SESSION["statut"]) && $_SESSION["statut"] == "Admin")
        { 
        ?>
        <a class="navbar-brand" href="admin.php">Administration</a>
        
    
        <?php }
        if(empty($_SESSION["pseudo"]))
        {
        ?>
        <a class="navbar-brand" href="connexion.php">Connexion</a>
        <a class="navbar-brand" href="inscription.php">Inscription</a>
        <?php
        }else{?>
            <a class="navbar-brand" href="profil.php?idUser=<?=$_SESSION["idUser"];?>"><?="[".$_SESSION["statut"]."] ".$_SESSION["pseudo"];?></a>
            <a class="navbar-brand" href="../traitements/deconnexion.php">Deconnexion</a>
<?php
        }
        ?>


    </nav>
<div class="container">
