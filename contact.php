<?php 
require_once('inc/init.inc.php');

$contenu = '';
$contact = array('Demande de devis', 'Problème avec une réservation', 'Autre demande');

// ---------  Traitement----------------

if(!empty($_POST)){
    if(strlen($_POST['nom']) <= 5){
        $contenu .= '<p> Votre nom doit comporter au moins cinq caractères</p>';
    }

    if(strlen($_POST['prenom']) <= 5){
        $contenu .= '<p>Votre prenom doit comporter au moins cinq caractères </p>';
    }

    if(!preg_match('#^[0-9]{10}$#', $_POST['telephone'])){
        $contenu .= '<p>Téléphone invalide</p>';
    }

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['email'] > 50){
        $contenu .= '<p> L\'email est invalide </p>';
    } 

    if($_POST['contact'] != 'Demande de devis' && $_POST['contact'] != 'Problème avec une réservation' && $_POST['contact'] != 'Autre demande'){
        $contenu .= '<p>Veuillez choisir un motif de contact valide</p>';
    }

    if(strlen($_POST['message']) <= 5){
        $contenu .= '<p> Le champ message doit comporter au moins 5 caractères </p>';
    }
}

// ----------- Affichage --------------
require_once('inc/header.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    p{
        color:red;
    }
    </style>
    <title>Contact</title>
</head>
<body>
    <?php echo $contenu; ?>
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
</body>
</html>

<?php
    require_once('inc/footer.php');
?>