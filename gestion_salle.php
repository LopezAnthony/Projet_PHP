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
    }

    if(isset($_POST['gestion_salle'])){
        if(strlen($_POST['description']) < 4 || strlen($_POST['description']) > 255){
            $contenu .= '<div class="bg-danger">Le titre doit contenir au moins 4 caractères</div>';
        }

        if(!preg_match('#^[0-9]{5}$#', $_POST['cp'])){ //preg_match retourne true si le string en deuxième argument correspond à l'expression régulière.
            $contenu .= '<div class="bg-danger">Code postal invalide</div>';
        }


        if(!empty($_FILES['photo']['name'])){ //si une image a été uploadée, $_FILES est remplie

            echo '<pre>'; print_r($_FILES); echo '</pre>';

            if($_FILES['photo']['error'] == 0 && $_FILES['photo']['type'] == 'image/jpeg' && $_FILES['photo']['size'] < 4){
                //on constitue un nom unique pour le fichier photo :
                $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];

                //on constitue le chemin de la photo enregistrée en BDD :
                $photo_bdd = RACINE_SITE . 'photo/' . $nom_photo; //on optient ici le nom et le chemin de la photo depuis la racine du site

                //On constitue le chemin absolu complet de la photo depuis la racine serveur :
                $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd;

                // echo '<pre>'; print_r($photo_dossier); echo '</pre>';

                //enregistrement du fichier photo sur le serveur :
                copy($_FILES['photo']['tmp_name'], $photo_dossier); //on copie le fichier temporaire de la photo stockée au chemin indiqué par $_FILES['photo']['tmp_name'] dans le chemin $photo_dossier de noter serveur
            }else{
                $contenu .= 'erreur photo';
            }
        }

    }




//--------------------------------AFFICHAGE----------------------------------
    require_once('inc/header.php');
?>

    <section>
        <form method="POST" enctype="multipart/form-data" action="">

            <input type="hidden" id="id_produit" name="id_produit" value="">

            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" placeholder="Titre de la salle" value="">

            <label for="description">Description :</label><br>
            <textarea name="description" id="description" placeholder="Description de la salee"></textarea>
            
            <label for="photo">Photo :</label><br>
            <input type="file" id="photo" name="photo">

            <label for="capacite">Capacité :</label>
            <select name="capacite" id="capacite">
                <?php for ($i = 0; $i < 31; $i++) { 
                    echo '<option value="'. $i .'">'. $i .'</option>';
                } ?>
            </select>

            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">
                <?php foreach($categorie as $indice){
                    echo '<option value="'. $categorie .'">'. $indice .'</option>';
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