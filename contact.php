<?php 
require_once('inc/init.inc.php');

if(!adminConnected()){
    header('location:/profil.php/');
    exit();
}

$contenu = '';
$contact = array('Demande de devis', 'Problème avec une réservation', 'Autre demande');

// ---------  Traitement----------------
















// ----------- Affichage --------------
require_once('inc/header.php');
?>

    <h1>Contactez-nous</h1>
    <form method="POST" action="">

    <label for="nom"> Nom : </label>
    <input type="text" name="nom" id="nom"> 

    <label for="prenom"> Prénom :</label> 
    <input type="text" name="prenom" id="prenom">

    <label for="telephone">Téléphone : </label>
	<input type="text" name="telephone" id="telephone">

    <label for="email"> Votre email : </label>
    <input type="text" id="email" name="email" value="">

    <label for="contact"> Motif du contact : </label>
        <select name="contact" id="contact">
        <option value="">---Motif du contact---</option>
        <?php 
        foreach($contact as $indice => $valeur){
            echo "<option value=$valeur>$valeur</option>";
        } ?>
        </select>
    
    <label for="message"> Votre message : </label>
    <textarea id="message" name="message"></textarea>

    <button type="submit">Envoyer</button>
    </form>

<?php
    require_once('inc/footer.php');
?>