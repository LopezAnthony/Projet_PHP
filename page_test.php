<?php
require_once('inc/init.inc.php');
//--------------------------TRAITEMENT-----------------------------
$resultat = $pdo->query("SELECT * FROM salle");

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
            <input type="range" id="range" name="prix" value="1000" min="0" max="2000" step="100">

        
            <label for="date_arrivee">Date de arrivée</label>
            <input type="text" name="date_arrivee" id="date_arrivee" value="" placeholder="00/00/0000 00:00">
            <label for="date_depart">Date de départ</label>
            <input type="text" name="date_depart" id="date_depart" value="" placeholder="00/00/0000 00:00">
        </form>

    </section>
    <section>

    </section>



<?php
require_once('inc/footer.php');
?>