<?php

function connexion($id, $mdp)
{
    $requete = getBdd() -> prepare("SELECT idUser, identifiant, email, nom, prenom, pseudo, mdp, statut FROM users WHERE identifiant = ?");
    $requete -> execute([$id]);

    if($requete -> rowCount() > 0)
    {
        $erreurs = 0;
        $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
        $nom = $utilisateur["nom"];
        $prenom = $utilisateur["prenom"];

            if(!password_verify($mdp, $utilisateur["mdp"]))
            {
                header("location:../pages/connexion.php?error=Mdp");
                $erreurs += 1;
            }

        if($erreurs == 0)
        {
        $_SESSION["idUser"] = $utilisateur["idUser"];
        $_SESSION["identifiant"] = $utilisateur["identifiant"];
        $_SESSION["statut"] = $utilisateur["statut"];
        $_SESSION["prenom"] = $prenom;
        $_SESSION["nom"] = $nom;
        $_SESSION["email"] = $utilisateur["email"];
        $_SESSION["pseudo"] = $utilisateur["pseudo"];
        return true;
        }
    }
}

function inscription($id, $email, $nom, $prenom, $dateNaiss, $pseudo, $mdp)
{
    $erreurs = 0;
    $nom = htmlspecialchars($nom, ENT_QUOTES);
    $prenom = htmlspecialchars($prenom, ENT_QUOTES);
    $pseudo = htmlspecialchars($pseudo, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    if($erreurs == 0)
    {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        try{
            $sql = "INSERT INTO users (identifiant, email, nom, prenom, pseudo, dateNaiss, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $requete = getBdd() -> prepare($sql);
            $requete -> execute([$id, $email, $nom, $prenom, $pseudo, $dateNaiss, $mdp]);
            return true;
            // header("location:index.php");
        }
        catch(Exception $e)
        {
        //    header("location:../pages/inscription.php?error=test");
        echo $e -> getMessage();
        }
        
    }
    
}

function modifUser($Nom,$Prenom,$Statut,$Pseudo,$email,$idUser){
    $Nom = htmlspecialchars($Nom, ENT_QUOTES);
    $Prenom = htmlspecialchars($Prenom, ENT_QUOTES);
    $Pseudo = htmlspecialchars($Pseudo, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    try{
        $requete = getBdd()->prepare("UPDATE users SET nom=?,prenom=?,statut=?,pseudo=?,email=? WHERE idUser = ?");
        $requete -> execute([$Nom,$Prenom,$Statut,$Pseudo,$email,$idUser]);
        return true;
    }catch(Exeption $e){
        header("location:../pages/admin.php?error=modifTable");
    }
}



function ajoutUser($identifiant,$nom,$prenom,$pseudo,$dateNaiss,$email, $mdp, $statut){
    $nom = htmlspecialchars($nom, ENT_QUOTES);
    $prenom = htmlspecialchars($prenom, ENT_QUOTES);
    $pseudo = htmlspecialchars($pseudo, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    $erreurs = "none";
    $requete = getBdd() -> prepare("SELECT identifiant FROM users WHERE identifiant = ?");
    $requete -> execute([$identifiant]);
    if($requete -> rowCount() > 0)
    {
        $erreurs = "uniqueIdentifiant";
        return $erreurs;
    }


    $requete = getBdd() -> prepare("SELECT email FROM users WHERE email = ?");
    $requete -> execute([$email]);
    if($requete -> rowCount() > 0)
    {
        $erreurs = "uniqueMail";
        return $erreurs;
    }

    $requete = getBdd() -> prepare("SELECT pseudo FROM users WHERE pseudo = ?");
    $requete -> execute([$pseudo]);
    if($requete -> rowCount() > 0)
    {
        $erreurs = "uniquePseudo";
        return $erreurs;
    }

    if($erreurs == "none"){
        try{
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $requete = getBdd() -> prepare("INSERT INTO users (identifiant, email, nom, prenom, pseudo, dateNaiss, mdp, statut) VALUES(?,?,?,?,?,?,?,?)");
        $requete->execute([$identifiant,$email,$nom,$prenom,$pseudo,$dateNaiss,$mdp,$statut]);
       
        return "success";
        }catch(Exception $e){
            $erreurs = $e->getMessage();
            return $erreurs;
        }
    }
}

function supprimerUtilisateur($idUser)
{
    $requete = getBdd() -> prepare("DELETE FROM users WHERE idUser = ?");
    $requete -> execute([$idUser]);
    $requete = getBdd() -> prepare("DELETE FROM sujet WHERE idUser = ?");
    $requete -> execute([$idUser]);
    $requete = getBdd() -> prepare("DELETE FROM moderateurs WHERE idUser = ?");
    $requete -> execute([$idUser]);
    $requete = getBdd() -> prepare("DELETE FROM messages WHERE idUser = ?");
    $requete -> execute([$idUser]);
    return true;
}

function modifProfil($idUser, $pseudo, $email)
{
    $pseudo = htmlspecialchars($pseudo, ENT_QUOTES);
    try{
        $requete = getBdd()->prepare("UPDATE users SET pseudo = ?, email = ? WHERE idUser = ?");
        $requete -> execute([$pseudo, $email, $idUser,]);
        $requete2 = getBdd() -> prepare("UPDATE sujet SET pseudo = ? WHERE idUser = ?");
        $requete2 -> execute([$pseudo, $idUser]);
        $requete2 = getBdd() -> prepare("UPDATE moderateurs SET pseudo = ? WHERE idUser = ?");
        $requete2 -> execute([$pseudo, $idUser]);
        $_SESSION["pseudo"] = $pseudo;
        return true;
    }catch(Exeption $e){
        header("location:../pages/profil.php?error=modifUser");
    }

}

function uploadImage($infoImage)
{
    $dossier = "../image/";
    $nom = $infoImage["image"]["name"];
    $fichier = $dossier . $nom;

    if(getimagesize($infoImage["image"]["tmp_name"]))
    {
        if($infoImage["image"]["size"] <= 1000000)
        {
            if($infoImage["image"]["type"] == "image/png" || $infoImage["image"]["type"] == "image/jpeg")
            {
                if(move_uploaded_file($infoImage["image"]["tmp_name"], $fichier))
                {
                   
                    try{
                        $requete = getBdd() -> prepare ("UPDATE users SET pdp = ? WHERE idUser = ?");
                        $requete -> execute([$fichier, $_SESSION["idUser"]]);
                        $id = $_SESSION["idUser"];
                    
                        return "success";
                    }catch(Exception $e)
                    {
                        
                    }
                }
                else
                {
                    return "Le fichier n'a pas pu être enregistré.";
                }
            }else
            {
                return "Le fichier est du mauvais type.";
            }
        }
        else
        {
            return "Le fichier est trop lourd.";
        }
    }else
    {
        return "Le fichier n'est pas une images.";
    }

}