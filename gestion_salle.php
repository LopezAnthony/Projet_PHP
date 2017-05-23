<?php
    require_once('inc/init.inc.php');

    if(!adminConnected()){
        header('location:/profil.php/');
        exit();
    }

    $categorie = array('reunion', 'bureau', 'conference', 'seminaire');
//-------------------------------TRAITEMENT----------------------------------

    if(isset($_POST['gestion_salle'])){

        if(strlen($_POST['titre']) < 4 || strlen($_POST['titre']) > 20){
            $contenu .= '<div class="bg-danger">Le titre doit contenir au moins 4 caractères</div>';
        }

        if(strlen($_POST['description']) < 4 || strlen($_POST['description']) > 255){
            $contenu .= '<div class="bg-danger">Le titre doit contenir au moins 4 caractères</div>';
        }

        if(!preg_match('#^[0-9]{5}$#', $_POST['cp'])){ //preg_match retourne true si le string en deuxième argument correspond à l'expression régulière.
            $contenu .= '<div class="bg-danger">Code postal invalide</div>';
        }


        if(!empty($_FILES['photo']['name'])){ //si une image a été uploadée, $_FILES est remplie
            if($_FILES['photo']['error'] == 0 && $_FILES['photo']['type'] == 'image/jpeg' && $_FILES['photo']['size'] < 2097152 ){
                //on constitue un nom unique pour le fichier photo :
                $nom_photo = $_POST['categories'] . '_' . $_FILES['photo']['name'];

                //on constitue le chemin de la photo enregistrée en BDD :
                $photo_bdd = RACINE_SITE . 'photo/' . $nom_photo; //on optient ici le nom et le chemin de la photo depuis la racine du site

                //On constitue le chemin absolu complet de la photo depuis la racine serveur :
                $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd;

                // echo '<pre>'; print_r($photo_dossier); echo '</pre>';

                //enregistrement du fichier photo sur le serveur :
                copy($_FILES['photo']['tmp_name'], $photo_dossier); //on copie le fichier temporaire de la photo stockée au chemin indiqué par $_FILES['photo']['tmp_name'] dans le chemin $photo_dossier de noter serveur
            }else{
                $contenu .= '<p>erreur photo</p>';
            }
        }

        if(is_numeric($_POST['capacite']) && $_POST['capacite'] < 0 && $_POST['capacite'] >= 30){
            $contenu .= '<p>erreur capacite</p>';
        }

        if(!in_array($_POST['categories'], $categorie) && $_POST['categories'] != 'NULL'){
            $contenu .= '<p>erreur categorie</p>';
        }

        if(strlen($_POST['pays']) < 2 || strlen($_POST['pays']) > 21){
            $contenu .= '<p>erreur Pays</p>';
        }

        if(strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 21){
            $contenu .= '<p>erreur Ville</p>';
        }

        if(strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50){
                    $contenu .= '<p>erreur adresse</p>';
        }

        if(empty($contenu)){
            foreach($_POST as $indice => $valeur){
                        $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
                    }
        

            $resultat = $pdo->prepare("INSERT INTO salle (titre, description, photo, pays, ville, adresse, cp, capacite, categories) VALUES(:titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categories)");

            $resultat->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
            $resultat->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
            $resultat->bindParam(':photo', $photo_bdd, PDO::PARAM_STR);
            $resultat->bindParam(':pays', $_POST['pays'], PDO::PARAM_STR);
            $resultat->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
            $resultat->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $resultat->bindParam(':cp', $_POST['cp'], PDO::PARAM_INT);
            $resultat->bindParam(':capacite', $_POST['capacite'], PDO::PARAM_INT);
            $resultat->bindParam(':categories', $_POST['categories'], PDO::PARAM_STR);

            $resultat->execute();

            $contenu .= '<p>La salle a bien été ajouté.</p>';
        }

    }




//--------------------------------AFFICHAGE----------------------------------
    require_once('inc/header.php');
?>

    <section>
        <?php echo $contenu; ?>
    </section>

    <section>
        <form method="POST" enctype="multipart/form-data" action="">

            <input type="hidden" id="id_produit" name="id_produit" value="">

            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" placeholder="Titre de la salle" value="">

            <label for="description">Description :</label><br>
            <textarea name="description" id="description" placeholder="Description de la salle"></textarea>
            
            <label for="photo">Photo :</label><br>
            <input type="file" id="photo" name="photo">

            <label for="capacite">Capacité :</label>
            <select name="capacite" id="capacite">
                <?php for ($i = 0; $i < 31; $i++) { 
                    echo '<option value="'. $i .'">'. $i .'</option>';
                } ?>
            </select>

            <label for="categories">Catégorie :</label>
            <select name="categories" id="categories" value="">
                <option value="NULL">--selectionner--</option>
                <?php foreach($categorie as $indice => $valeur){
                    echo '<option value="'. $valeur .'">'. $valeur .'</option>';
                } ?>
            </select>

            <label for="pays">Pays :</label>
            <input type="text" id="pays" name="pays" placeholder="France">

            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" placeholder="Paris">

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" placeholder="Adresse de la salle">

            <label for="cp">Code Postal</label>
            <input type="text" id="cp" name="cp" placeholder="Code Postal de la salle">

            <input type="submit" value="Enregistrer" name="gestion_salle">
        </form>
    </section>

<?php
    require_once('inc/footer.php');
?>