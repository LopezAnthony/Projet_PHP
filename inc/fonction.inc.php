<?php

//------- userConnected()
function userConnected(){
    if(isset($_SESSION['membre'])){
        return true;
    }else{
        return false;
    }
}

//------- adminConnected()
function adminConnected(){
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1){
        return true;
    }else{
        return false;
    }
}

//------- executeRequete()

function executeRequete($req, $param = array()){ //$param est un array vide par défaut : il est donc optionnel

    //htmlspecialchars :
        if(!empty($param)){
            //si on a bien reçu un array, on le traite :
            foreach($param as $indice => $valeur){
                $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); //transforme en entités HTML chaque caractères spéciaux, dont les quotes
            }
        }

    //La requête préparée :
        global $pdo; //$pdo est déclarée dans l'espace global (fichier init.inc.php). Il faut donc faire global $pdo pour l'utiliser dans l'espace local de cette fonction.
        $r = $pdo->prepare($req);
        $succes = $r->execute($param); //on exécute la requête en lui passant l'array $param qui permet d'associer chaque marqueur à sa valeur.

    //Traitement erreur SQL éventuelle :
        if(!$succes){ //si $succes vaut false, il y a une erreur sur la requête
            die('Erreur sur la requête SQL : ' . $r->errorInfo()[2] ); //die arrête le script et affiche un message. Ici on affiche le message d'erreur SQL donné par errorInfo(). Cette méthode retourne un array, dans lequel le message se situe à l'indice [2]
        }
        
        return $r; //Retourne un objet PDOStatement qui contient le resultat de la requête.

}


?>
