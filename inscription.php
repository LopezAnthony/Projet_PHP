<?php

//-------------------TRAITEMENT----------------------
    require_once('inc/init.inc.php');

        $inscription = false; //variable qui permet de savoir si le membre est inscrit, pour ne pas réafficher le formulaire d'inscription

        //Traitement du POST:
            if(!empty($_POST)){ //si le formulaire est posté

                //validation du formulaire :
                if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20){
                    $contenu .= '<div class="bg-danger">Le pseudo doit contenir au moins 4 caractères</div>';
                }

                if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 60){
                    $contenu .= '<div class="bg-danger">Le mot de passe doit contenir au moins 4 caractères</div>';
                }

                if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20){
                    $contenu .= '<div class="bg-danger">Le nom doit contenir au moins 2 caractères</div>';
                }

                if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20){
                    $contenu .= '<div class="bg-danger">Le prenom doit contenir au moins 2 caractères</div>';
                }

                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['email'] > 50){
                    $contenu .= '<div class="bg-danger">Email invalide</div>';
                }

                if($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'){
                    $contenu .= '<div class="bg-danger">La civilité est incorrect</div>';
                }

                if(empty($contenu)){ //si contenue est vide, c'est qu'il n'y a pas d'erreur

                    $membre = $pdo->prepare("SELECT id_membre FROM membre WHERE pseudo = :pseudo"); //on vérifie l'existence du pseudo

                    if($membre->rowCount() > 0){ //Si il y a des lignes dans le reultat de la requête
                        $contenu .= '<div class="bg-danger">Le pseudo est indisponible : veuillez en choisir un autre</div>';
                    } else{
                        //si le pseudo est unique, on peut faire l'inscription en BDD:
                        $_POST['mdp'] = md5($_POST['mdp']); //permet d'encrypter le mot de passe selon l'algorithme md5. Il faudra le faire aussi sur la page de connexion pour comparer 2 mots cryptés

                        executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, 0, date() )", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], ':email' => $_POST['email'], ':civilite' => $_POST['civilite']));

                        $contenu .= '<p>Vous êtes inscrit. <a href="connexion.php">Cliquez ici pour vous connecter</a></p>';
                        $inscription = true; //pour ne plus afficher le formulaire d'inscription.
                    }//fin du else de if ($membre->rowCount()>0)
                }//fin du if(empty($contenu))
            } //fin du if(!empty($_POST))


//-------------------AFFICHAGE----------------------
    echo $contenu; //affiche les messages du site


    ?>
    <h3>Veuillez renseigner le formulaire pour vous inscrire</h3>
        <form method="post" action="">

            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" value="">

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" value="">

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="">

            <label for="prenom">Prenom :</label>
            <input type="text" id="prenom" name="prenom" value="">

            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="">

            <label for="civilite">Civilité :</label>
            <input type="radio" name="civilite" id="homme" value="m" checked><label for="homme">Homme</label>
            <input type="radio" name="civilite" id="femme" value="f" ><label for="femme">Femme</label>

            <input type="submit" name="inscription" value="s'inscrire">

        </form>