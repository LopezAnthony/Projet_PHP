<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <?php require_once('inc/inscription.php'); ?>
                    <?php require_once('inc/connexion.php'); ?>
                    <li><a href="page_test.php">SalleA</a></li>
                    <li><a href="about.php">Qui sommes nous</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href=""><i class="fa fa-user" aria-hidden="true"></i>Espace Membre</a>
                        <ul>
                            <?php if(!userConnected()) : ?>
                            
                            <li><a href="#" id="inscription">Inscription</a></li>
                            <li><a href="" id="connexion">Connexion</a></li>
                            
                            <?php else : ?>
                            
                            <li><a href="?action=deconnexion">Deconnexion</a></li>
                            <li><a href="">Profil</a></li>

                            <?php endif ?>

                            <?php if(adminConnected()) : ?>

                            <li><a href="gestion_salle.php">Gestion des salles</a></li>
                            <li><a href="gestion_produit.php">Gestion des produits</a></li>
                            <li><a href="gestion_membre.php">Gestion des membres</a></li>
                            <li><a href="gestion_avis.php">Gestion des avis</a></li>
                            <li><a href="gestion_commande.php">Gestion des commandes</a></li>
                            <li><a href="statistiques.php">Statistiques</a></li>

                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <main>