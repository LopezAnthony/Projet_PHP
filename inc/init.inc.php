<?php
    //connexion BDD
    $pdo = new PDO('mysql:host=localhost; dbname=sallea', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    //Initialisation session
    session_start();

    //variable affichage.
    $contenu ='';

    //pour les fonctions
    require_once('fonction.inc.php');
?>
