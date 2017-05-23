<?php
    require_once('inc/init.inc.php');

    if(!adminConnected()){
        header('location:/profil.php/');
        exit();
    }



//-------------------------------TRAITEMENT----------------------------------
$result = $pdo->query("SELECT * FROM salle");
//--------------------------------AFFICHAGE----------------------------------
require_once('inc/header.php');
?>

<section>
    <form method="POST" action="">
        <label for="date_arrivee">Date d'arrivée</label>
        <i class="fa fa-envelope" aria-hidden="true"></i><input type="text" name="date_arrivee" value="" placeholder="jj/mm/aaaa 00:00">

        <label for="date_depart">Date de départ</label>
        <i class="fa fa-envelope" aria-hidden="true"></i><input type="text" name="date_depart" value="" placeholder="jj/mm/aaaa 00:00">

        <label for="salle">Salle</label>
        <select>
            <?php while($ligne = $result->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$ligne['id_salle'].'">'. $ligne['id_salle'] .' - '. $ligne['titre'] .' - '. $ligne['adresse'] .' - '. $ligne['cp'] .' - '. $ligne['ville'] .' - '. $ligne['capacite'] .'</option>';
            }?>
        </select>

        <label for="tarif">Tarif</label>
        <i class="fa fa-eur" aria-hidden="true"></i><input type="number" name="tarif" value="" placeholder="Prix en euros">

        <input type="submit" name="gestion_produit" value="Enregistrer">
    </form>
</section>

<?php
    require_once('inc/footer.php');
?>