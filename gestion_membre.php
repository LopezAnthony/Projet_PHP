<?php
    require_once('inc/init.inc.php');

    if(!adminConnected()){
        header('location:/profil.php/');
        exit();
    }

$civilite = array('m' => 'Homme', 'f' => 'Femme');

$statut = array('1' => 'Admin', '0' => 'Membre');

//-------------------------------TRAITEMENT----------------------------------

//--------------------------------AFFICHAGE----------------------------------
require_once('inc/header.php');
?>

<section>
    <form method="POST" action="">
        <label for="pseudo">Pseudo</label>
        <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="pseudo" value="" placeholder="Pseudo">

        <label for="mdp">Mot de passe</label>
        <i class="fa fa-lock" aria-hidden="true"></i><input type="password" name="mdp" value="" placeholder="Mot de passe">

        <label for="nom">Nom</label>
        <i class="fa fa-pencil" aria-hidden="true"></i><input type="text" name="nom" value="" placeholder="Votre nom">

        <label for="prenom">Prénom</label>
        <i class="fa fa-pencil" aria-hidden="true"></i><input type="text" name="prenom" value="" placeholder="Votre prénom">

        <label for="email">Email</label>
        <i class="fa fa-envelope" aria-hidden="true"></i><input type="email" name="email" value="" placeholder="Votre email">

        <label for="civilite">Civilité</label>
        <select>
            <?php foreach($civilite as $indice){
                    echo '<option value="'. $civilite .'">'. $indice .'</option>';
                } ?>
        </select>

        <select>
            <?php foreach($statut as $indice){
                    echo '<option value="'. $statut .'">'. $indice .'</option>';
                } ?>
        </select>

        <input type="submit" name="gestion_membres" value="Enregistrer">
    </form>
</section>

<?php
    require_once('inc/footer.php');
?>

