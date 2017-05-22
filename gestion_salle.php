<?php
    require_once('inc/init.inc.php');

    if(!adminConnected()){
        header('location:/profil.php/');
        exit();
    }

    $categorie = array('reunion', 'bureau', 'conference', 'seminaire');
//-------------------------------TRAITEMENT----------------------------------


//--------------------------------AFFICHAGE----------------------------------
    require_once('inc/header.php');
?>

    <section>
        <form method="POST" enctype="multipart/form-data" action="">

            <input type="hidden" id="id_produit" name="id_produit" value="">

            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" placeholder="Titre de la salle" value="">

            <label for="description">description</label>
            <textarea name="description" id="descruotion" placeholder="Description de la salee"></textarea>

            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">

            <label for="capacite">Capacite</label>
            <select name="capacite" id="capacite">
                <?php for ($i = 0; $i < 31; $i++) { 
                    echo '<option value="'. $i .'">'. $i .'</option>';
                } ?>
            </select>

            <label for="categorie">categorie</label>
            <select name="categorie" id="categorie">
                <?php foreach($categorie as $indice){
                    echo '<option value="'. $categorie .'">'. $indice .'</option>';
                } ?>
            </select>

            <label for="pays">Pays</label>
            <input type="text" id="pays" name="pays" placeholder="France">

            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" placeholder="Paris">

            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" placeholder="adresse de la salle">

            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" placeholder="Code Postal de la salle">

            <input type="submit" value="Enregistrer">
        </form>
    </section>

<?php
    require_once('inc/footer.php');
?>