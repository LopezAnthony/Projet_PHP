<?php
require_once('inc/init.inc.php');
//--------------------------TRAITEMENT-----------------------------

// Si visiteur est connecté, on l'envoie vers connexion.php:
        if(!userConnected()){
            header('location:page_test.php');  // Nous l'invitons à ce connecter.
            exit();
        }
        $contenu .= '<div><h2>Bonjour ' . $_SESSION['membre']['pseudo'] . ' !</h2>';
        // On affiche le statut du membre:
        if($_SESSION['membre']['statut']==1){
            $contenu .= '<p>Vous êtes un administrateur</p>';
        }else{
            $contenu .= '<p>Vous etes un membre</p>';
        }
        $contenu .= '<h3>Voici vos informations de profil:</h3>';
            $contenu .= '<p>Votre pseudo: '. $_SESSION['membre']['pseudo'] . '</p>';
            $contenu .= '<p>Votre email: '. $_SESSION['membre']['email'] . '</p>';
            $contenu .= '<p>Votre prenom: '. $_SESSION['membre']['prenom'] . '</p>';
            $contenu .= '<p>Votre nom: '. $_SESSION['membre']['nom'] . '</p>';
            $contenu .= '<p>Votre sexe: '. $_SESSION['membre']['civilite'] . '</p>';
        $contenu .= '</div>';
//---------------------------AFFICHAGE-----------------------------
require_once('inc/header.php');
?>

<?php
echo $contenu;
require_once('inc/footer.php');
?>