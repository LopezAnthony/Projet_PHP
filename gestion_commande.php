<?php
require_once('inc/init.inc.php');

if(!adminConnected()){
    header('location:/profil.php/');
    exit();
}

//-------------------------------TRAITEMENT----------------------------------
$commande = $pdo->query("SELECT id_commande, id_membre, id_produit, date_enregistrement, prix, email FROM commande c INNER JOIN produit p ON c.id_produit = p.id_produit INNER JOIN membre m ON c.id_membre = m.id_membre");

$contenu .= '<h1>Gestion des commandes</h1>
			<table border="1">';
		$contenu .= '<tr>
						<th>id commande</th>
						<th>id membre</th>
						<th>id produit</th>
						<th>prix</th>
						<th>date_enregistrement</th>
					</tr>';
while($afficheCommande = $commande->fetch(PDO::FETCH_ASSOC)){
    $contenu .= '<tr>
                    <td>'. $afficheCommande['id_commande'] .'</td>
                    <td>'. $afficheCommande['id_membre'] .' - '. $afficheCommande['email'] .'</td>
                    <td>'. $afficheCommande['id_produit'] .'</td>
                    <td>'. $afficheCommande['prix'] .'</td>
                    <td>'. $afficheCommande['date_enregistrement'] .'</td>
                </tr>';
}










//--------------------------------AFFICHAGE----------------------------------
require_once('inc/header.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des commandes</title>
</head>
<body>
    <?php echo $contenu; ?>
</body>
</html>



<?php
    require_once('inc/footer.php');
?>
