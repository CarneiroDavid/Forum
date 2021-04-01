<?php
session_start();
 
function getBdd()
{
    return new PDO('mysql:host=localhost;dbname=forum;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

require_once "categories.php";
// require_once "pageProfil.php";
require_once "messages.php";
require_once "sujet.php";
require_once "utilisateurs.php";
require_once "moderateurs.php";
require_once "../affichages/affichage.php";