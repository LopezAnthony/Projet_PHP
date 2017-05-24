<?php

//-------------------TRAITEMENT----------------------
    require_once('inc/init.inc.php');

        $inscription = false; //variable qui permet de savoir si le membre est inscrit, pour ne pas réafficher le formulaire d'inscription

        //Traitement du POST:
            if(isset($_POST['inscription'])){ //si le formulaire est posté

                //validation du formulaire :
                if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20){
                    $contenu .= '<div>Le pseudo doit contenir au moins 4 caractères</div>';
                }

                if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 60){
                    $contenu .= '<div>Le mot de passe doit contenir au moins 4 caractères</div>';
                }

                if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20){
                    $contenu .= '<div>Le nom doit contenir au moins 2 caractères</div>';
                }

                if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20){
                    $contenu .= '<div>Le prenom doit contenir au moins 2 caractères</div>';
                }

                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['email'] > 50){
                    $contenu .= '<div>Email invalide</div>';
                }

                if($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'){
                    $contenu .= '<div>La civilité est incorrect</div>';
                }

                if(empty($contenu)){

                    foreach($_POST as $indice => $valeur){
                        $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
                    }

                    $resultat = $pdo->prepare("SELECT id_membre FROM membre WHERE pseudo = :pseudo"); //on vérifie l'existence du pseudo
                    $resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);

                    $resultat->execute(); 

                    if($resultat->rowCount() > 0){ //Si il y a des lignes dans le reultat de la requête
                        $contenu .= '<div>Le pseudo est indisponible : veuillez en choisir un autre</div>';
                    } else{
                        //si le pseudo est unique, on peut faire l'inscription en BDD:
                        $_POST['mdp'] = md5($_POST['mdp']); //permet d'encrypter le mot de passe selon l'algorithme md5. Il faudra le faire aussi sur la page de connexion pour comparer 2 mots cryptés

                        $resultat = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, 0, NOW() )");

                        $resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                        $resultat->bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
                        $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                        $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                        $resultat->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                        $resultat->bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
                        
                        $resultat->execute();

                        $contenu .= '<p>Vous êtes inscrit.</p>';
                    }//fin du else de if ($membre->rowCount()>0)
                }//fin du if(empty($contenu))
            } //fin du if(!empty($_POST))


//-------------------AFFICHAGE----------------------


?>
    <section class="modal hidden">
        <article>
            <h3>Inscription <i class="fa fa-times" aria-hidden="true"></i></h3>
                <form method="post" action="">

                <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" value="">

                <input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" value="">

                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" value="">

                <input type="text" id="nom" name="nom" placeholder="Votre nom" value="">

                <input type="text" id="email" name="email" placeholder="Votre email" value="">

                    <label for="civilite">Civilité :</label>
                    <input type="radio" name="civilite" id="homme" value="m" checked>
                    <label for="homme">Homme</label>
                    <input type="radio" name="civilite" id="femme" value="f" >
                    <label for="femme">Femme</label>

                    <input type="submit" name="inscription" value="s'inscrire" name="inscription">
                </form>
        </article>
        </section>