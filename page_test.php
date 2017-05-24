<?php
require_once('inc/init.inc.php');
//--------------------------TRAITEMENT-----------------------------
$resultat = $pdo->query("SELECT * FROM salle");

$produit = $pdo->query("SELECT produit.*, salle.* FROM produit INNER JOIN salle ON salle.id_salle = produit.id_salle WHERE produit.id_salle = salle.id_salle");

//---------------------------AFFICHAGE-----------------------------
require_once('inc/header.php');
?>

    <section>
        <p>Catégories</p>
        <ul>
            <?php 
                while ( $select = $resultat->fetch(PDO::FETCH_ASSOC )) {
                        echo '<li><a href="?categories='. $select['categories'] .'">'. $select['categories'] .'</a></li>'; 
                }
            ?>
        </ul>

        <p>Ville</p>

        <form method="post" action="">
            <label for="capacite">Capacité</label>
            <select name="capacite" id="capacite">
                <option value="NULL">--selectionnée--</option>
                
            </select>

            <label for="prix">Prix</label>

            <label for="date_arrivee">Date de arrivée</label>
            <input type="text" name="date_arrivee" id="date_arrivee" value="" placeholder="00/00/0000 00:00">
            <label for="date_depart">Date de départ</label>
            <input type="text" name="date_depart" id="date_depart" value="" placeholder="00/00/0000 00:00">
        </form>

    </section>
    <section>
        <?php while($affichage = $produit->fetch(PDO::FETCH_ASSOC)){
            echo '<figure>
                    <figcaption>'. $affichage['titre'] .'</figcaption>
                    <img src="'. $affichage['photo'] .'" alt="">
                </figure>
                <p>'. $affichage['description'] .'</p>
                <p><i class="fa fa-calendar" aria-hidden="true"></i> '. $affichage['date_arrivee'] .' au '. $affichage['date_depart'] .'</p>
                <p>prix : '. $affichage['prix'] .'</p>
                <p><a href=""><i class="fa fa-search" aria-hidden="true"></i> Voir</a></p>';
        } ?>
    </section>



<?php
require_once('inc/footer.php');
?>