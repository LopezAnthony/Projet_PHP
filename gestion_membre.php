<?php
    require_once('inc/init.inc.php');

    if(!adminConnected()){
        header('location:/profil.php/');
        exit();
    }

$civilite = array('m' => 'Homme', 'f' => 'Femme');

$statut = array('1' => 'Admin', '0' => 'Membre');

//-------------------------------TRAITEMENT----------------------------------
if(isset($_POST['gestion_membre'])){
// die(var_dump($_POST));



        if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){
            $contenu .= '<p>Le titre doit contenir au moins 4 caractères</p>';
        }

        if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 60){
            $contenu .= '<p>Le mot de passe doit contenir au moins 4 caractères</p>';
        }

        if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20){
            $contenu .= '<p>Le nom doit contenir au moins 2 caractères</p>';
        }

        if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20){
            $contenu .= '<p>Le prenom doit contenir au moins 2 caractères</p>';
        }

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['email'] > 50){
            $contenu .= '<p>Email invalide</p>';
        }

        if($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'){
            $contenu .= '<p>La civilité est incorrect</p>';
        }

        if($_POST['statut'] != '1' && $_POST['statut'] != '0'){
            $contenu .= '<p>Statut incorrect</p>';
        }

        if(empty($contenu)){
            foreach($_POST as $indice => $valeur){
                $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
            }

            $result = $pdo->prepare("SELECT id_membre FROM membre WHERE pseudo = :pseudo");
                $result->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);

                $result->execute(); 

            if($result->rowCount() > 0){
                $contenu .= '<p>Le pseudo est indisponible : veuillez en choisir un autre</p>';
            }else{
                $_POST['mdp'] = md5($_POST['mdp']);

                $result = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, NOW() )");

                $result->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $result->bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
                $result->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                $result->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $result->bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
                $result->bindParam(':statut', $_POST['statut'], PDO::PARAM_INT);
                
                $result->execute();
            }
        }
}


//--------------------------------AFFICHAGE----------------------------------
require_once('inc/header.php');
echo  $contenu;
?>


<section>
    <form method="post" action="">
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
        <select name="civilite">
            <?php foreach($civilite as $indice => $valeur){
                    echo '<option value="'. $indice .'">'. $valeur .'</option>';
                } ?>
        </select>

        <label for="statut">Statut</label>
        <select name="statut">
            <?php foreach($statut as $indice => $valeur){
                    echo '<option value="'. $indice .'">'. $valeur .'</option>';
                } ?>
        </select>

        <input type="submit" name="gestion_membre" value="Enregistrer">
    </form>
</section>

<?php
    require_once('inc/footer.php');
?>

