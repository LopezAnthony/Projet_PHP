<?php
    require_once('inc/init.inc.php');

    if(!adminConnected()){
        header('location:/page_test.php/');
        exit();
    }

//-------------------------------TRAITEMENT----------------------------------
$result = $pdo->query("SELECT * FROM salle");

    if(isset($_POST['gestion_produit'])){

        $date_arrivee = $_POST['date_arrivee'];
        if(!validateDate($date_arrivee, $format = 'd/m/Y H:i')){
            $contenu .= 'erreur date';
        }else{
            $dateArrivee = new DateTime($date_arrivee);
            $date_arrivee = $dateArrivee->format('d-m-Y H:i');
        }

        $date_depart = $_POST['date_depart'];
        if(!validateDate($date_depart, $format = 'd/m/Y H:i')){
            $contenu .= 'erreur date';
        }else{
            $dateDepart = new DateTime($date_depart);
            $date_depart = $dateDepart->format('d-m-Y H:i');
        }

        if(!is_numeric($_POST['salle']) && $_POST['salle'] != 0){
            $contenu .= '<p>Pas bon</p>';
        }

        if(!is_numeric($_POST['prix'])){
            $contenu .= '<p>Toujours pas bon</p>';
        }

        if(empty($contenu)){
            foreach($_POST as $indice => $valeur){
                $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
            }

                
                $result = $pdo->prepare("INSERT INTO produit (id_salle, date_arrivee, date_depart, prix ) VALUES (:id_salle, :date_arrivee, :date_depart, :prix )");

                $result->bindParam(':id_salle', $_POST['salle'], PDO::PARAM_INT);
                $result->bindParam(':date_arrivee', $date_arrivee, PDO::PARAM_STR);
                $result->bindParam(':date_depart', $date_depart, PDO::PARAM_STR);
                $result->bindParam(':prix', $_POST['prix'], PDO::PARAM_INT);

                $date_depart .= ':00';
                $date_arrivee .= ':00';

                $result->execute();
        }
    }
//--------------------------------AFFICHAGE----------------------------------
require_once('inc/header.php');
echo $contenu;
?>

<section>

<?php echo $contenu; ?>
    <form method="POST" action="">
        <label for="date_arrivee">Date d'arrivée</label>
        <i class="fa fa-envelope" aria-hidden="true"></i><input type="text" name="date_arrivee" value="" placeholder="jj/mm/aaaa 00:00">

        <label for="date_depart">Date de départ</label>
        <i class="fa fa-envelope" aria-hidden="true"></i><input type="text" name="date_depart" value="" placeholder="jj/mm/aaaa 00:00">

        <label for="salle">Salle</label>
        <select name="salle">
            <?php while($ligne = $result->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$ligne['id_salle'].'">'. $ligne['id_salle'] .' - '. $ligne['titre'] .' - '. $ligne['adresse'] .' - '. $ligne['cp'] .' - '. $ligne['ville'] .' - '. $ligne['capacite'] .'</option>';
            }?>
        </select>

        <label for="tarif">Tarif</label>
        <i class="fa fa-eur" aria-hidden="true"></i><input type="text" name="prix" value="" placeholder="Prix en euros">

        <input type="submit" name="gestion_produit" value="Enregistrer">
    </form>
</section>

<?php
    require_once('inc/footer.php');
?>