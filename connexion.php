<?php
require_once('inc/init.inc.php');

//--------------------------TRAITEMENT-----------------------------


//---------------------------AFFICHAGE-----------------------------

    echo $contenu;
    ?>

    <h3>Veuillez renseigner vos identifiants pour vous connecter</h3>
    <form method="post" action="">
        <label for="pseudo">Pseudo :</label><br>
        <input type="text" id="pseudo" name="pseudo" value=""><br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" value=""><br><br>

        <input type="submit" value="se connecter" class="btn">
    </form>


